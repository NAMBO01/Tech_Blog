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
                <a href="#">Sign Up</a>
            </div>
        </div>
    </div>

    <style>
        .login2-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #7b6cf6 0%, #a084ee 100%);
            padding: 20px;
        }

        .login2-card {
            background: #fff;
            border-radius: 28px;
            box-shadow: 0 8px 32px rgba(80, 80, 160, 0.13), 0 1.5px 8px rgba(160, 132, 238, 0.08);
            padding: 44px 32px 32px 32px;
            width: 100%;
            max-width: 370px;
            display: flex;
            flex-direction: column;
            align-items: center;
            animation: slideUp 0.6s cubic-bezier(.23, 1.01, .32, 1);
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login2-title {
            font-size: 2.2rem;
            font-weight: 800;
            color: #3d246c;
            margin-bottom: 32px;
            letter-spacing: 0.5px;
            text-align: center;
        }

        .login2-form {
            width: 100%;
            display: flex;
            flex-direction: column;
            gap: 20px;
            padding: 0;
            margin: 0;
        }

        .login2-input-group {
            width: 100%;
            padding: 0;
            margin: 0;
        }

        .login2-input {
            width: 100%;
            padding: 16px 20px;
            border: 2px solid #ece6fa;
            border-radius: 16px;
            background: #f6f6fa;
            box-shadow: 0 2px 8px rgba(102, 126, 234, 0.06);
            font-size: 1.08rem;
            color: #333;
            margin: 0;
            outline: none;
            transition: box-shadow 0.2s, background 0.2s, border 0.2s;
            box-sizing: border-box;
            display: block;
        }

        .login2-input:focus {
            background: #fff;
            border: 2px solid #a084ee;
            box-shadow: 0 0 0 3px #a084ee33;
        }

        .login2-btn {
            width: 100%;
            padding: 15px 0;
            border: none;
            border-radius: 24px;
            background: linear-gradient(90deg, #a084ee 0%, #fca7ea 100%);
            color: #fff;
            font-size: 1.13rem;
            font-weight: 700;
            letter-spacing: 1px;
            cursor: pointer;
            margin-top: 10px;
            margin-bottom: 10px;
            box-shadow: 0 2px 12px rgba(160, 132, 238, 0.13);
            transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
        }

        .login2-btn:hover {
            background: linear-gradient(90deg, #fca7ea 0%, #a084ee 100%);
            transform: translateY(-2px) scale(1.03);
            box-shadow: 0 6px 24px rgba(160, 132, 238, 0.18);
        }

        .login2-error {
            color: #e53e3e;
            background: #fee;
            border-radius: 10px;
            padding: 11px 16px;
            font-size: 1rem;
            margin-bottom: 6px;
            text-align: center;
            border: 1px solid #fed7d7;
        }

        .login2-or {
            color: #888;
            font-size: 1.01rem;
            margin: 20px 0 12px 0;
            text-align: center;
            font-weight: 500;
        }

        .login2-socials {
            display: flex;
            justify-content: center;
            gap: 26px;
            margin-bottom: 22px;
        }

        .login2-social-btn {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 48px;
            height: 48px;
            border-radius: 50%;
            background: #f6f6fa;
            box-shadow: 0 2px 12px rgba(160, 132, 238, 0.10);
            transition: box-shadow 0.2s, background 0.2s, transform 0.15s;
            border: none;
            outline: none;
        }

        .login2-social-btn:hover {
            background: #f0e9ff;
            box-shadow: 0 6px 24px rgba(160, 132, 238, 0.18);
            transform: scale(1.08);
        }

        .login2-social-btn svg {
            width: 26px;
            height: 26px;
            display: block;
        }

        .login2-signup {
            text-align: center;
            margin-top: 10px;
        }

        .login2-signup a {
            background: linear-gradient(90deg, #a084ee 0%, #fca7ea 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-fill-color: transparent;
            text-decoration: none;
            font-weight: 700;
            font-size: 1.08rem;
            transition: text-decoration 0.2s, opacity 0.2s;
            opacity: 0.95;
        }

        .login2-signup a:hover {
            text-decoration: underline;
            opacity: 1;
        }

        @media (max-width: 480px) {
            .login2-card {
                padding: 20px 4px 14px 4px;
                margin: 8px;
            }

            .login2-title {
                font-size: 1.3rem;
            }

            .login2-social-btn {
                width: 40px;
                height: 40px;
            }

            .login2-social-btn svg {
                width: 22px;
                height: 22px;
            }
        }
    </style>
@endsection
