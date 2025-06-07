<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Exception;

class LoginController extends Controller
{
    // Xử lý đăng nhập thông thường
    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        // Mã hóa mật khẩu bằng MD5
        $credentials['password'] = md5($credentials['password']);

        // Tìm user theo email và password đã mã hóa
        $user = User::where('email', $credentials['email'])
            ->where('password_hash', $credentials['password'])
            ->first();

        if ($user) {
            Auth::login($user);
            // Cập nhật thời gian đăng nhập cuối
            $user->update(['last_login' => now()]);
            return redirect()->route('admin.dashboard');
        }

        return back()->withErrors([
            'email' => 'Email hoặc mật khẩu không đúng.',
        ]);
    }

    // Xử lý đăng xuất
    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('login_admin')->with('success', 'Đăng xuất thành công');
    }

    // Chuyển hướng đến Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    // Xử lý callback từ Google
    public function handleGoogleCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
            $finduser = User::where('google_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                $finduser->update(['last_login' => now()]);
                return redirect()->route('admin.dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'google_id' => $user->id,
                    'password_hash' => md5(rand(1, 10000)) // Tạo mật khẩu ngẫu nhiên và mã hóa MD5
                ]);

                Auth::login($newUser);
                $newUser->update(['last_login' => now()]);
                return redirect()->route('admin.dashboard');
            }
        } catch (Exception $e) {
            return redirect()->route('login_admin')->with('error', 'Đăng nhập bằng Google thất bại');
        }
    }

    // Chuyển hướng đến Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Xử lý callback từ Facebook
    public function handleFacebookCallback()
    {
        try {
            $user = Socialite::driver('facebook')->user();
            $finduser = User::where('facebook_id', $user->id)->first();

            if ($finduser) {
                Auth::login($finduser);
                $finduser->update(['last_login' => now()]);
                return redirect()->route('admin.dashboard');
            } else {
                $newUser = User::create([
                    'name' => $user->name,
                    'email' => $user->email,
                    'facebook_id' => $user->id,
                    'password_hash' => md5(rand(1, 10000)) // Tạo mật khẩu ngẫu nhiên và mã hóa MD5
                ]);

                Auth::login($newUser);
                $newUser->update(['last_login' => now()]);
                return redirect()->route('admin.dashboard');
            }
        } catch (Exception $e) {
            return redirect()->route('login_admin')->with('error', 'Đăng nhập bằng Facebook thất bại');
        }
    }
}
