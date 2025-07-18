@extends('template.template_admin')
@section('main-content')
    <style>
        .user-form-card {
            border-radius: 1.2rem;
            box-shadow: 0 4px 24px rgba(37, 117, 252, 0.08);
            border: none;
            max-width: 500px;
            margin: 0 auto;
            margin-top: 2rem;
        }

        .user-form-label {
            font-size: 0.97rem;
            color: #8a8fa7;
            font-weight: 500;
            margin-bottom: 0.25rem;
            letter-spacing: 0.02em;
        }

        .user-form-input {
            font-size: 1.13rem;
            border-radius: 0.7rem;
            padding: 0.7rem 1.1rem;
            border: 1.5px solid #e3e6f0;
            background: #f8f9fc;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        .user-form-input:focus {
            border-color: #2575fc;
            box-shadow: 0 0 0 0.15rem rgba(37, 117, 252, .13);
            background: #fff;
        }

        .btn-gradient {
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            font-weight: 600;
            border: none;
            border-radius: 2rem;
            padding: 0.6em 1.6em;
            box-shadow: 0 2px 8px rgba(37, 117, 252, 0.10);
            transition: background 0.2s, box-shadow 0.2s;
        }

        .btn-gradient:hover {
            background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
            color: #fff;
            box-shadow: 0 4px 16px rgba(37, 117, 252, 0.16);
        }

        .btn-cancel {
            background: #e2e6ea;
            color: #222b45;
            border: none;
            margin-left: 0.7rem;
            font-weight: 500;
            border-radius: 2rem;
            padding: 0.6em 1.3em;
            transition: background 0.2s;
        }

        .btn-cancel:hover {
            background: #d1d5db;
        }

        @media (max-width: 767.98px) {
            .user-form-card {
                border-radius: 0.7rem;
                margin-top: 1rem;
            }

            .user-form-input {
                font-size: 1rem;
                padding: 0.5rem 0.8rem;
            }
        }
    </style>
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800 text-center">Phân quyền / Sửa người dùng</h1>
        <h5 class="text-center mb-3 text-primary">Tên người dùng: <strong>{{ $user->name }}</strong></h5>
        <div class="card user-form-card p-4">
            <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="form-group">
                    <label for="name" class="user-form-label">Tên</label>
                    <input type="text" class="form-control user-form-input" id="name" name="name"
                        value="{{ $user->display_name }}" required>
                </div>
                <div class="form-group">
                    <label for="email" class="user-form-label">Email</label>
                    <input type="email" class="form-control user-form-input" id="email" name="email"
                        value="{{ $user->email }}" required>
                </div>
                <div class="form-group">
                    <label for="role" class="user-form-label">Vai trò</label>
                    <select class="form-control user-form-input" id="role" name="role" required>
                        <option value="admin" @if ($user->role == 'admin') selected @endif>Quản trị viên</option>
                        <option value="author" @if ($user->role == 'author') selected @endif>Tác giả</option>
                        <option value="user" @if ($user->role == 'user') selected @endif>Đọc giả</option>
                    </select>
                </div>
                <div class="text-center mt-4">
                    <button type="submit" class="btn btn-gradient">Lưu</button>
                    <a href="{{ route('admin.users.index') }}" class="btn btn-cancel ml-2">Quay lại</a>
                </div>
            </form>
        </div>
    </div>
@endsection
