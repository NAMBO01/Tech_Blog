<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginUserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Mã hóa mật khẩu bằng MD5
        $credentials['password'] = md5($credentials['password']);

        // Tìm user theo email và password đã mã hóa (trường password_hash)
        $user = \App\Models\User::where('email', $credentials['email'])
            ->where('password_hash', $credentials['password'])
            ->first();

        if ($user) {
            Auth::login($user, $request->filled('remember'));
            $request->session()->regenerate();
            return redirect()->intended('/');
        }
        return back()->withErrors([
            'email' => 'Thông tin đăng nhập không đúng.',
        ])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
