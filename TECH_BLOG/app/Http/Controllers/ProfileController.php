<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function index()
    {
        $user = User::find(Auth::id());

        return view('admin.profile_admin', compact('user'));
    }

    public function update(Request $request)
    {
        $user = User::find(Auth::id());

        $request->validate([
            'display_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:users,email,' . $user->id,
            'current_password' => 'required_with:new_password',
            'new_password' => [
                'nullable',
                'string',
                'min:8',
                'confirmed',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[^a-zA-Z0-9]).{8,}$/'
            ],
            'bio' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'avatar' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048'
        ], [
            'new_password.regex' => 'Mật khẩu mới phải có ít nhất 8 ký tự, bao gồm chữ thường, chữ hoa, số và ký tự đặc biệt.',
            'avatar.image' => 'File tải lên phải là ảnh.',
            'avatar.mimes' => 'Ảnh đại diện phải có định dạng jpeg, png, jpg hoặc gif.',
            'avatar.max' => 'Ảnh đại diện không được vượt quá 2MB.'
        ]);

        $user->display_name = $request->display_name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        $user->website = $request->website;

        // Xử lý upload avatar
        if ($request->hasFile('avatar')) {
            $file = $request->file('avatar');
            $filename = 'avatar_' . $user->id . '_' . time() . '.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('avatars', $filename, 'public');
            $user->avatar_url = 'storage/' . $path;
        }

        $changedPassword = false;
        // Nếu có thay đổi mật khẩu
        if ($request->filled('current_password')) {
            if (md5($request->current_password) !== $user->password_hash) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
            }
            $user->password_hash = md5($request->new_password);
            $changedPassword = true;
        }

        $user->save();

        if ($changedPassword) {
            return redirect()->route('admin.profile')->with('success', 'Đổi mật khẩu thành công');
        } else {
            return redirect()->route('admin.profile')->with('success', 'Cập nhật thông tin thành công');
        }
    }

    public function userProfile()
    {
        $user = Auth::user();
        return view('user.profile', compact('user'));
    }
}
