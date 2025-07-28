<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = trim($request->get('q'));

        if (empty($query)) {
            return redirect()->route('home');
        }

        // Debug: Log query để kiểm tra
        Log::info('Search query: ' . $query);

        // Tìm kiếm bài viết - bỏ điều kiện status để test
        $posts = Post::where(function ($q) use ($query) {
            $q->where('title', 'LIKE', "%{$query}%")
                ->orWhere('content', 'LIKE', "%{$query}%")
                ->orWhere('summary', 'LIKE', "%{$query}%");
        })
            ->with(['category', 'field', 'author', 'tags'])
            ->orderBy('created_at', 'desc')
            ->paginate(10);

        // Debug: Log số lượng bài viết tìm được
        Log::info('Found posts: ' . $posts->count());

        // Tìm kiếm danh mục
        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->orWhere('description', 'LIKE', "%{$query}%")
            ->get();

        // Tìm kiếm tags
        $tags = Tag::where('name', 'LIKE', "%{$query}%")
            ->get();

        // Tìm kiếm tác giả
        $authors = User::where('name', 'LIKE', "%{$query}%")
            ->orWhere('email', 'LIKE', "%{$query}%")
            ->get();

        return view('search.results', compact('posts', 'categories', 'tags', 'authors', 'query'));
    }

    public function ajaxSearch(Request $request)
    {
        $query = $request->get('q');

        if (empty($query)) {
            return response()->json([]);
        }

        $results = [];

        // Tìm kiếm bài viết
        $posts = Post::where('status', 'published')
            ->where(function ($q) use ($query) {
                $q->where('title', 'LIKE', "%{$query}%")
                    ->orWhere('summary', 'LIKE', "%{$query}%");
            })
            ->with(['category', 'author'])
            ->limit(5)
            ->get();

        foreach ($posts as $post) {
            $results[] = [
                'type' => 'post',
                'title' => $post->title,
                'url' => route('posts.show', $post->slug),
                'category' => $post->category->name ?? '',
                'author' => $post->author->name ?? '',
                'summary' => substr($post->summary, 0, 100) . '...'
            ];
        }

        // Tìm kiếm danh mục
        $categories = Category::where('name', 'LIKE', "%{$query}%")
            ->limit(3)
            ->get();

        foreach ($categories as $category) {
            $results[] = [
                'type' => 'category',
                'title' => $category->name,
                'url' => route('categories.show', $category->slug),
                'description' => $category->description ?? ''
            ];
        }

        // Tìm kiếm tags
        $tags = Tag::where('name', 'LIKE', "%{$query}%")
            ->limit(3)
            ->get();

        foreach ($tags as $tag) {
            $results[] = [
                'type' => 'tag',
                'title' => '#' . $tag->name,
                'url' => route('tags.show', $tag->slug)
            ];
        }

        return response()->json($results);
    }
}
