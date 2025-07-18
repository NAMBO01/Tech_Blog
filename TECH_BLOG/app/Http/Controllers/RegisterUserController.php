<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class RegisterUserController extends Controller
{
    public function showRegisterUser()
    {
        return view('auth.register');
    }

    public function registerUser(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'username' => 'required|string|max:50|unique:users,username',
            'email' => 'required|email|unique:users',
            'password' => 'required|string|min:8|confirmed',
        ]);
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password_hash' => bcrypt($request->password), // mã hóa mật khẩu và lưu vào password_hash
            'phone_number' => '0000000000', // giá trị mặc định, user có thể cập nhật sau
            'role' => 'reader', // hoặc 'user' nếu bạn muốn
        ]);
        auth()->login($user);
        return redirect()->route('home')->with('success', 'Đăng ký thành công!');
    }
}
