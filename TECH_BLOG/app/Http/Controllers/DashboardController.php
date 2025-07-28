<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use App\Models\Comment;
use App\Models\Visit;
use Carbon\Carbon;

class DashboardController extends Controller
{
    public function index()
    {
        // Lấy tổng số lượt truy cập
        // $totalVisits = Visit::count();

        // // Lấy lượt truy cập hôm nay
        // $todayVisits = Visit::whereDate('created_at', Carbon::today())->count();

        // Lấy tổng số bài viết
        $totalPosts = Post::count();

        // Lấy tổng số bình luận
        $totalComments = Comment::count();

        return view('admin.index_admin', compact(
            // 'totalVisits',
            // 'todayVisits',
            'totalPosts',
            'totalComments'
        ));
    }
}
