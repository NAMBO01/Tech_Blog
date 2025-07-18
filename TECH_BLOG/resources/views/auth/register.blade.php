@extends('template.template_user')
@section('main-content')
    <link rel="stylesheet" href="/user/register.css">
    <div class="register-container">
        <form method="POST" action="{{ route('register') }}" class="register-form">
            @csrf
            <h2 class="register-title">Đăng ký tài khoản</h2>
            <div class="form-group">
                <label>Họ tên</label>
                <input type="text" name="name" class="form-control" value="{{ old('name') }}" required>
                @error('name')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Tên đăng nhập</label>
                <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                @error('username')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Số điện thoại</label>
                <input type="text" name="phone_number" class="form-control" value="{{ old('phone_number') }}" required>
                @error('phone_number')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                @error('email')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Mật khẩu</label>
                <input type="password" name="password" class="form-control" required>
                @error('password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label>Nhập lại mật khẩu</label>
                <input type="password" name="password_confirmation" class="form-control" required>
            </div>
            <button type="submit" class="btn-register">Đăng ký</button>
            <div style="text-align:center; margin-top: 1.5rem;">
                Đã có tài khoản? <a href="{{ route('login') }}">Đăng nhập</a>
            </div>
        </form>
    </div>
@endsection
