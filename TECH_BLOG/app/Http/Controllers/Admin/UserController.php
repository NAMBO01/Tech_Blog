<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin');
    }

    public function index()
    {
        $users = User::all();
        return view('admin.users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'username' => 'required|string|max:50|unique:users,username',
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email',
            'phone_number' => 'required|string|max:10',
            'password' => 'required|string|min:8',
            'role' => 'required|in:admin,author,reader',
            'display_name' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'website' => 'nullable|url|max:255',
        ]);

        $user = new User();
        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->password_hash = Hash::make($request->password);
        $user->role = $request->role;
        $user->display_name = $request->display_name;
        $user->bio = $request->bio;
        $user->website = $request->website;
        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Thêm người dùng thành công!');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('admin.users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        $request->validate([
            'username' => 'required|string|max:50|unique:users,username,' . $user->id,
            'name' => 'required|string|max:50',
            'email' => 'required|email|unique:users,email,' . $user->id,
            'phone_number' => 'required|string|max:10',
            'role' => 'required|in:admin,author,reader',
            'display_name' => 'nullable|string|max:100',
            'bio' => 'nullable|string',
            'website' => 'nullable|url|max:255',
            'password' => 'nullable|string|min:8',
        ]);

        $user->username = $request->username;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->phone_number = $request->phone_number;
        $user->role = $request->role;
        $user->display_name = $request->display_name;
        $user->bio = $request->bio;
        $user->website = $request->website;

        // Cập nhật password nếu có
        if ($request->filled('password')) {
            $user->password_hash = Hash::make($request->password);
        }

        $user->save();

        return redirect()->route('admin.users.index')->with('success', 'Cập nhật người dùng thành công!');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        // Không cho phép xóa chính mình
        if ($user->id === auth()->id()) {
            return redirect()->route('admin.users.index')->with('error', 'Không thể xóa tài khoản của chính mình!');
        }

        $user->delete();
        return redirect()->route('admin.users.index')->with('success', 'Xóa người dùng thành công!');
    }
}
