<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        // Kiểm tra xem user đã đăng nhập chưa
        if (!auth()->check()) {
            return redirect()->route('login_admin')->with('error', 'Bạn cần đăng nhập để truy cập trang này.');
        }

        // Kiểm tra xem user có phải là admin hoặc author không
        if (!auth()->user()->isAdminOrAuthor()) {
            // Đừng redirect về route admin/dashboard, mà về trang chủ hoặc trang login
            return redirect('/')->with('error', 'Bạn không có quyền truy cập!');
        }

        return $next($request);
    }
}
