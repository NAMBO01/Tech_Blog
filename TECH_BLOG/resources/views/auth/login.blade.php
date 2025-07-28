@extends('template.template_user')

@section('main-content')
    <div class="login2-container">
        <div class="login2-card">
            <h2 class="login2-title">Sign In</h2>
            <form method="POST" action="{{ route('login') }}" class="login2-form">
                @csrf
                <div class="login2-input-group">
                    <input type="text" name="email" class="login2-input" placeholder="username or email" required
                        autofocus>
                </div>
                <div class="login2-input-group">
                    <input type="password" name="password" class="login2-input" placeholder="password" required>
                </div>
                @if ($errors->any())
                    <div class="login2-error">{{ $errors->first() }}</div>
                @endif
                <button type="submit" class="login2-btn">SIGN IN</button>
            </form>
            <div class="login2-or">Or login with</div>
            <div class="login2-socials">
                <a href="#" class="login2-social-btn" title="Login with Facebook">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="12" fill="#fff" />
                        <path
                            d="M15.36 8.5H13.5V7.5C13.5 7.22 13.72 7 14 7H15.36V5H13.5C12.12 5 11 6.12 11 7.5V8.5H9V10.5H11V19H13.5V10.5H15.09L15.36 8.5Z"
                            fill="#1877F3" />
                    </svg>
                </a>
                <a href="#" class="login2-social-btn" title="Login with Google">
                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                        <circle cx="12" cy="12" r="12" fill="#fff" />
                        <path
                            d="M21.6 12.227c0-.818-.073-1.597-.209-2.345H12v4.44h5.377a4.6 4.6 0 0 1-2.001 3.018v2.5h3.23c1.89-1.74 2.994-4.3 2.994-7.613z"
                            fill="#4285F4" />
                        <path
                            d="M12 22c2.7 0 4.97-.89 6.627-2.41l-3.23-2.5c-.9.6-2.05.96-3.397.96-2.61 0-4.82-1.76-5.61-4.13H3.04v2.59A9.997 9.997 0 0 0 12 22z"
                            fill="#34A853" />
                        <path
                            d="M6.39 13.92A5.99 5.99 0 0 1 6 12c0-.67.12-1.32.34-1.92V7.49H3.04A9.997 9.997 0 0 0 2 12c0 1.64.39 3.19 1.04 4.51l3.35-2.59z"
                            fill="#FBBC05" />
                        <path
                            d="M12 6.58c1.47 0 2.78.51 3.81 1.51l2.86-2.86C16.97 3.89 14.7 3 12 3A9.997 9.997 0 0 0 3.04 7.49l3.35 2.59C7.18 8.34 9.39 6.58 12 6.58z"
                            fill="#EA4335" />
                    </svg>
                </a>
            </div>
            <div class="login2-signup">
                <a href="{{ route('register') }}">Sign Up</a>
            </div>
        </div>
    </div>

    @push('styles')
        <link rel="stylesheet" href="{{ asset('user/login.css') }}">
    @endpush
@endsection
