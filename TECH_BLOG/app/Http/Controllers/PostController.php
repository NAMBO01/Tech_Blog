<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Field;
use App\Models\Tag;
use App\Models\Media;
use App\Models\PostRevision;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\View;
use App\Models\View as PostView;

class PostController extends Controller
{
    public function index()
    {
        $query = Post::with(['category', 'field', 'tags', 'author'])->latest();
        if (auth()->check() && auth()->user()->role === 'author') {
            $query->where('author_id', auth()->id());
        }
        $posts = $query->paginate(10);
        return view('admin.post_admin', compact('posts'));
    }

    public function create()
    {
        $categories = Category::all();
        $fields = Field::all();
        $tags = Tag::all();
        return view('admin.posts.create', compact('categories', 'fields', 'tags'));
    }

    public function store(Request $request)
    {
        try {
            Log::info('Bắt đầu tạo bài viết mới', ['request' => $request->all()]);

            $request->validate([
                'title' => 'required|max:255',
                'slug' => 'required|unique:posts',
                'summary' => 'required',
                'content' => 'required',
                'category_id' => 'required|exists:categories,id',
                'field_id' => 'required|exists:fields,id',
                'tags' => 'required|array',
                'tags.*' => 'exists:tags,id',
                'status' => 'required|in:draft,review,published',
                'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);

            Log::info('Validation passed');

            DB::beginTransaction();

            // Tạo bài viết mới
            $post = new Post();
            $post->title = $request->title;
            $post->slug = $request->slug;
            $post->summary = $request->summary;
            $post->content = $request->content;
            $post->category_id = $request->category_id;
            $post->field_id = $request->field_id;
            $post->status = $request->status;
            $post->author_id = auth()->id();

            // Xử lý ảnh bìa
            if ($request->hasFile('cover_image')) {
                $coverPath = $request->file('cover_image')->store('covers', 'public');
                $post->cover_image_url = Storage::url($coverPath);
                Log::info('Đã upload ảnh bìa', ['cover_path' => $coverPath]);
            }

            // Lưu bài viết
            $post->save();
            Log::info('Đã lưu bài viết', ['post_id' => $post->id]);

            // Nếu có nút Lưu bản nháp, luôn lưu status là 'draft'
            if ($request->has('save_as_draft')) {
                $post->status = 'draft';
                $post->save();
            } else if (!auth()->user() || auth()->user()->role !== 'admin') {
                // Nếu không phải admin, chuyển trạng thái sang 'review'
                $post->status = 'review';
                $post->save();
            }

            // Lưu tags
            $post->tags()->sync($request->tags);
            Log::info('Đã lưu tags', ['tags' => $request->tags]);

            DB::commit();
            Log::info('Đã commit transaction');

            return redirect()->route('admin.post_admin')->with('success', 'Bài viết đã được tạo thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Lỗi khi tạo bài viết: ' . $e->getMessage(), [
                'exception' => $e,
                'trace' => $e->getTraceAsString()
            ]);
            return back()->with('error', 'Có lỗi xảy ra khi tạo bài viết: ' . $e->getMessage())->withInput();
        }
    }

    public function edit(Post $post)
    {
        // Kiểm tra quyền chỉnh sửa
        if (auth()->user()->role === 'author' && $post->author_id !== auth()->id()) {
            return redirect()->route('admin.post_admin')->with('error', 'Bạn không có quyền chỉnh sửa bài viết này!');
        }

        $categories = Category::all();
        $fields = Field::all();
        $tags = Tag::all();
        return view('admin.posts.edit', compact('post', 'categories', 'fields', 'tags'));
    }

    public function update(Request $request, Post $post)
    {
        // Author chỉ được sửa bài của mình, admin sửa tất cả
        if (auth()->user()->role === 'author' && $post->author_id !== auth()->id()) {
            return redirect()->route('admin.post_admin')->with('error', 'Bạn không có quyền sửa bài viết này!');
        }
        $validated = $request->validate([
            'title' => 'required|max:255',
            'slug' => 'required|unique:posts,slug,' . $post->id,
            'summary' => 'nullable',
            'content' => 'required',
            'cover_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'category_id' => 'required|exists:categories,id',
            'field_id' => 'required|exists:fields,id',
            'tags' => 'nullable|array',
            'tags.*' => 'exists:tags,id',
            'status' => 'required|in:draft,review,published'
        ]);
        if ($request->hasFile('cover_image')) {
            if ($post->cover_image_url) {
                Storage::delete('public/' . $post->cover_image_url);
            }
            $image = $request->file('cover_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $image->storeAs('public/posts', $imageName);
            $validated['cover_image_url'] = 'posts/' . $imageName;
        }
        if ($post->status !== 'published' && $validated['status'] === 'published') {
            $validated['published_at'] = now();
        }
        // Lưu revision trước khi update
        $maxRevision = $post->revisions()->max('revision_number') ?? 0;
        $revision = new PostRevision([
            'post_id' => $post->id,
            'content' => $post->content,
            'revision_number' => $maxRevision + 1,
            'edited_by' => auth()->id(),
            'edited_at' => now()
        ]);
        $revision->save();
        $post->update($validated);
        $post->tags()->sync($request->tags ?? []);
        return redirect()->route('admin.post_admin')->with('success', 'Cập nhật thành công!');
    }

    public function destroy(Post $post)
    {
        // Kiểm tra quyền xóa
        if (auth()->user()->role === 'author' && $post->author_id !== auth()->id()) {
            return redirect()->route('admin.post_admin')->with('error', 'Bạn không có quyền xóa bài viết này!');
        }

        try {
            DB::beginTransaction();

            // Delete cover image
            if ($post->cover_image_url) {
                Storage::delete('public/' . $post->cover_image_url);
            }

            // Delete post
            $post->delete();

            DB::commit();
            Log::info('Post deleted successfully', ['post_id' => $post->id]);

            return redirect()->route('admin.post_admin')
                ->with('success', 'Bài viết đã được xóa thành công.');
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error('Error deleting post: ' . $e->getMessage());
            return back()->with('error', 'Có lỗi xảy ra khi xóa bài viết: ' . $e->getMessage());
        }
    }

    public function show($slug)
    {
        $post = Post::with(['category', 'field', 'tags', 'author', 'comments'])
            ->where('slug', $slug)
            ->where('status', 'published')
            ->firstOrFail();

        // Tăng lượt xem
        $post->increment('view_count');

        // Lưu thông tin lượt xem
        PostView::create([
            'post_id' => $post->id,
            'ip_address' => request()->ip(),
            'user_agent' => request()->userAgent(),
            'viewed_at' => now()
        ]);

        // Lấy bài viết liên quan
        $relatedPosts = Post::where('category_id', $post->category_id)
            ->where('id', '!=', $post->id)
            ->where('status', 'published')
            ->latest()
            ->take(3)
            ->get();

        return view('posts.show', compact('post', 'relatedPosts'));
    }

    public function rate(Post $post, Request $request)
    {
        $request->validate([
            'rating' => 'required|integer|min:1|max:5'
        ]);

        $rating = $post->ratings()->updateOrCreate(
            ['user_id' => auth()->id()],
            ['rating' => $request->rating]
        );

        return back()->with('success', 'Cảm ơn bạn đã đánh giá bài viết!');
    }

    public function bookmark(Request $request, Post $post)
    {
        $user = auth()->user();
        if (!$user) {
            return redirect()->route('login');
        }

        // Toggle bookmark
        if ($post->bookmarks()->where('user_id', $user->id)->exists()) {
            $post->bookmarks()->detach($user->id);
            $message = 'Đã bỏ lưu bài viết!';
        } else {
            $post->bookmarks()->attach($user->id);
            $message = 'Đã lưu bài viết!';
        }

        if ($request->ajax()) {
            return response()->json(['success' => true, 'message' => $message]);
        }

        return back()->with('success', $message);
    }

    public function revisions(Post $post)
    {
        // Kiểm tra quyền xem lịch sử
        if (auth()->user()->role === 'author' && $post->author_id !== auth()->id()) {
            return redirect()->route('admin.post_admin')->with('error', 'Bạn không có quyền xem lịch sử bài viết này!');
        }

        $revisions = $post->revisions()->with('editor')->orderBy('revision_number', 'desc')->get();
        return view('admin.posts.revisions', compact('post', 'revisions'));
    }

    public function restoreRevision(Post $post, PostRevision $revision)
    {
        // Kiểm tra quyền khôi phục
        if (auth()->user()->role === 'author' && $post->author_id !== auth()->id()) {
            return redirect()->route('admin.posts.revisions', $post)->with('error', 'Bạn không có quyền khôi phục bài viết này!');
        }

        try {
            DB::beginTransaction();

            // Tạo revision mới trước khi khôi phục
            $maxRevision = $post->revisions()->max('revision_number') ?? 0;
            $currentRevision = new PostRevision([
                'post_id' => $post->id,
                'content' => $post->content,
                'revision_number' => $maxRevision + 1,
                'edited_by' => auth()->id(),
                'edited_at' => now()
            ]);
            $currentRevision->save();

            // Khôi phục từ revision cũ
            $post->update([
                'content' => $revision->content
            ]);

            DB::commit();

            return redirect()->route('admin.posts.edit', $post)->with('success', 'Đã khôi phục phiên bản thành công!');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi khôi phục phiên bản: ' . $e->getMessage());
        }
    }

    public function comment(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);
        $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
        ]);
        return back()->with('success', 'Bình luận của bạn đã được gửi!');
    }

    public function commentAjax(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string|max:1000',
        ]);

        $comment = $post->comments()->create([
            'user_id' => auth()->id(),
            'content' => $request->content,
            'parent_comment_id' => $request->parent_comment_id ?? null,
        ]);

        $user = $comment->user;
        $avatar = $user && $user->avatar_url ? $user->avatar_url : asset('admin_page/img/undraw_profile.svg');
        $name = $user && $user->name ? $user->name : 'Ẩn danh';
        $created = $comment->created_at->format('d/m/Y H:i');
        $content = e($comment->content);

        $html = '<div class="media mb-4 align-items-center">'
            . '<img src="' . $avatar . '" class="mr-3 rounded-circle border" style="width:48px; height:48px; object-fit:cover; box-shadow:0 2px 8px rgba(44,62,80,0.08);" alt="avatar">'
            . '<div class="media-body">'
            . '<div class="d-flex align-items-center mb-1">'
            . '<h6 class="mt-0 mb-0 font-weight-bold mr-2" style="font-size:1.08rem;">' . $name . '</h6>'
            . '<small class="text-muted" style="font-size:0.95rem;">' . $created . '</small>'
            . '</div>'
            . '<div style="font-size:1.08rem; line-height:1.6; color:#222;">' . $content . '</div>'
            . '</div>'
            . '</div>';

        return response()->json([
            'success' => true,
            'html' => $html,
            'message' => 'Bình luận của bạn đã được gửi!'
        ]);
    }
}
