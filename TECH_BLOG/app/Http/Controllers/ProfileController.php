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
        $user = DB::table('users')
            ->where('id', Auth::id())
            ->first();

        return view('admin.profile_admin', compact('user'));
    }

    public function update(Request $request)
    {
        $user = DB::table('users')
            ->where('id', Auth::id())
            ->first();

        $request->validate([
            'display_name' => 'required|string|max:100',
            'email' => 'required|string|email|max:150|unique:users,email,' . $user->id,
            'current_password' => 'required_with:new_password',
            'new_password' => 'nullable|min:6|confirmed',
            'bio' => 'nullable|string',
            'website' => 'nullable|url|max:255'
        ]);

        $updateData = [
            'display_name' => $request->display_name,
            'email' => $request->email,
            'bio' => $request->bio,
            'website' => $request->website
        ];

        // Nếu có thay đổi mật khẩu
        if ($request->filled('current_password')) {
            if (!Hash::check($request->current_password, $user->password_hash)) {
                return back()->withErrors(['current_password' => 'Mật khẩu hiện tại không đúng']);
            }
            $updateData['password_hash'] = Hash::make($request->new_password);
        }

        DB::table('users')
            ->where('id', $user->id)
            ->update($updateData);

        return redirect()->route('admin.profile')->with('success', 'Cập nhật thông tin thành công');
    }
}
