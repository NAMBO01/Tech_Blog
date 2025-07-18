<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UpdateLastLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if (Auth::check()) {
            $user = Auth::user();
            if ($user instanceof \App\Models\User) {
                // Chỉ update nếu quá 1 phút kể từ lần cuối (giảm ghi DB liên tục)
                if (!$user->last_login || now()->diffInMinutes($user->last_login) > 0) {
                    $user->last_login = now();
                    $user->save();
                }
            }
        }
        return $next($request);
    }
}
