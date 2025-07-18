@extends('template.template_user')

@section('title', 'Thông tin cá nhân')

@push('css')
    <style>
        body {
            background: #f7f9fb;
            font-family: 'Segoe UI', 'Roboto', Arial, sans-serif;
        }

        .profile-container {
            display: flex;
            justify-content: center;
            align-items: flex-start;
            gap: 40px;
            margin-top: 48px;
            margin-bottom: 48px;
        }

        .profile-avatar-box {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: flex-start;
            min-width: 180px;
        }

        .profile-avatar {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            object-fit: cover;
            border: 4px solid #fff;
            background: linear-gradient(135deg, #2563eb 0%, #6c47d6 100%);
            box-shadow: 0 4px 24px rgba(80, 80, 160, 0.13), 0 0 0 4px #e3e6f0;
            margin-bottom: 18px;
            transition: box-shadow 0.2s, transform 0.2s;
        }

        .profile-avatar:hover {
            box-shadow: 0 8px 32px rgba(80, 80, 160, 0.18), 0 0 0 6px #b3b8f7;
            transform: scale(1.04);
        }

        .profile-info-list {
            display: flex;
            flex-direction: column;
            gap: 18px;
            min-width: 320px;
            max-width: 480px;
            width: 100%;
        }

        .profile-info-card {
            background: #fff;
            border-radius: 1.3rem;
            box-shadow: 0 2px 16px rgba(80, 80, 160, 0.08);
            padding: 18px 22px;
            display: flex;
            align-items: center;
            gap: 14px;
            min-height: 54px;
            transition: box-shadow 0.2s;
            border: 1px solid #f0f1f7;
        }

        .profile-info-card:hover {
            box-shadow: 0 8px 32px rgba(80, 80, 160, 0.13);
        }

        .profile-info-icon {
            background: linear-gradient(135deg, #2563eb 0%, #6c47d6 100%);
            color: #fff;
            border-radius: 50%;
            width: 32px;
            height: 32px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.1rem;
            flex-shrink: 0;
            box-shadow: 0 1px 4px rgba(80, 80, 160, 0.08);
        }

        .profile-info-content {
            display: flex;
            flex-direction: column;
            align-items: flex-start;
            justify-content: center;
        }

        .profile-info-label {
            color: #7a7e9a;
            font-size: 0.98rem;
            font-weight: 500;
            margin-bottom: 1px;
            letter-spacing: 0.1px;
        }

        .profile-info-value {
            color: #222;
            font-size: 1.12rem;
            font-weight: 600;
            word-break: break-all;
        }

        .profile-info-value a {
            color: #2563eb;
            text-decoration: none;
            border-bottom: 1px dashed #2563eb;
            transition: border 0.2s;
        }

        .profile-info-value a:hover {
            border-bottom: 2px solid #2563eb;
            color: #6c47d6;
        }

        @media (max-width: 900px) {
            .profile-container {
                flex-direction: column;
                align-items: center;
                gap: 28px;
            }

            .profile-info-list {
                min-width: 0;
                width: 100%;
                max-width: 98vw;
            }

            .profile-avatar-box {
                min-width: 0;
            }
        }

        @media (max-width: 600px) {
            .profile-info-card {
                padding: 12px 7px;
                gap: 8px;
            }

            .profile-avatar {
                width: 70px;
                height: 70px;
            }

            .profile-info-icon {
                width: 22px;
                height: 22px;
                font-size: 0.95rem;
            }
        }
    </style>
@endpush

@section('main-content')
    <div class="container">
        <div class="profile-container">
            <div class="profile-avatar-box">
                <img src="{{ $user->avatar_url ?? asset('admin_page/img/undraw_profile.svg') }}" alt="Avatar"
                    class="profile-avatar">
            </div>
            <div class="profile-info-list">
                <div class="profile-info-card">
                    <div class="profile-info-icon"><i class="fas fa-user"></i></div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Tên đăng nhập</div>
                        <div class="profile-info-value">{{ $user->username ?? $user->email }}</div>
                    </div>
                </div>
                <div class="profile-info-card">
                    <div class="profile-info-icon"><i class="fas fa-id-badge"></i></div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Tên hiển thị</div>
                        <div class="profile-info-value">{{ $user->display_name ?? $user->name }}</div>
                    </div>
                </div>
                <div class="profile-info-card">
                    <div class="profile-info-icon"><i class="fas fa-envelope"></i></div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Email</div>
                        <div class="profile-info-value">{{ $user->email }}</div>
                    </div>
                </div>
                @if ($user->phone_number)
                    <div class="profile-info-card">
                        <div class="profile-info-icon"><i class="fas fa-phone"></i></div>
                        <div class="profile-info-content">
                            <div class="profile-info-label">Số điện thoại</div>
                            <div class="profile-info-value">{{ $user->phone_number }}</div>
                        </div>
                    </div>
                @endif
                <div class="profile-info-card">
                    <div class="profile-info-icon"><i class="fas fa-info-circle"></i></div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Giới thiệu</div>
                        <div class="profile-info-value">{{ $user->bio ?? '-' }}</div>
                    </div>
                </div>
                <div class="profile-info-card">
                    <div class="profile-info-icon"><i class="fas fa-globe"></i></div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Website</div>
                        <div class="profile-info-value">
                            @if ($user->website)
                                <a href="{{ $user->website }}" target="_blank">{{ $user->website }}</a>
                            @else
                                -
                            @endif
                        </div>
                    </div>
                </div>
                <div class="profile-info-card">
                    <div class="profile-info-icon"><i class="fas fa-user-shield"></i></div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Vai trò</div>
                        <div class="profile-info-value">{{ $user->role == 'reader' ? 'Đọc giả' : ucfirst($user->role) }}
                        </div>
                    </div>
                </div>
                <div class="profile-info-card">
                    <div class="profile-info-icon"><i class="fas fa-calendar-plus"></i></div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Ngày tạo</div>
                        <div class="profile-info-value">
                            {{ $user->created_at ? $user->created_at->format('d/m/Y H:i') : '-' }}</div>
                    </div>
                </div>
                <div class="profile-info-card">
                    <div class="profile-info-icon"><i class="fas fa-sign-in-alt"></i></div>
                    <div class="profile-info-content">
                        <div class="profile-info-label">Lần đăng nhập cuối</div>
                        <div class="profile-info-value">
                            {{ $user->last_login ? \Carbon\Carbon::parse($user->last_login)->format('d/m/Y H:i') : '-' }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
