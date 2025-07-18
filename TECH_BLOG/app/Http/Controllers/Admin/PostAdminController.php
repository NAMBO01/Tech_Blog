<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;

class PostAdminController extends Controller
{
    public function index()
    {
        $posts = Post::with(['category', 'field', 'tags', 'author'])->latest()->paginate(10);
        return view('admin.post_admin', compact('posts'));
    }
}
