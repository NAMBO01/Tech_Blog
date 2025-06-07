<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{
    public function index()
    {
        $posts = DB::table('posts')
            ->select('posts.*', 'categories.name as category_name', 'users.display_name as author_name')
            ->leftJoin('categories', 'posts.category_id', '=', 'categories.id')
            ->leftJoin('users', 'posts.author_id', '=', 'users.id')
            ->orderBy('posts.created_at', 'desc')
            ->paginate(10);

        return view('admin.post_admin', compact('posts'));
    }

    public function destroy($id)
    {
        try {
            DB::table('posts')->where('id', $id)->delete();

            return redirect()->route('admin.post_admin')
                ->with('success', 'Xóa bài viết thành công');
        } catch (\Exception $e) {
            return redirect()->route('admin.post_admin')
                ->with('error', 'Không thể xóa bài viết: ' . $e->getMessage());
        }
    }
}
