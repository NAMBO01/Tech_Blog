@php
    use App\Models\Category;
    use App\Models\Tag;
    $categories = Category::all();
    $tags = Tag::all();
@endphp
<header class="tt-header">
    <div class="tt-header-top">
        <div class="tt-logo">
            <a href="{{ route('home') }}">
                <img src="/admin_page/img/logo2.png" alt="Logo" class="tt-logo-img">
            </a>
        </div>
        <form class="tt-search">
            <input type="text" placeholder="Tìm sản phẩm công nghệ, cộng đồng, bạn bè...">
        </form>
        <div class="tt-header-actions">
            <a href="#" class="tt-btn-share">Viết Bài Chia Sẻ</a>
            <a href="#" class="tt-icon"><i class="fas fa-envelope"></i></a>
            <a href="#" class="tt-icon"><i class="fas fa-bell"></i></a>

            <div class="user-menu">
                @if (Auth::check())
                    <button class="user-menu-btn">
                        <i class="fas fa-caret-down"></i>
                    </button>
                    <div class="user-dropdown">
                        <a href="#">Trang cá nhân</a>
                        <a href="{{ route('user.profile') }}">Thông tin cá nhân</a>
                        <hr class="dropdown-divider">
                        <a href="#">Bookmark</a>
                        <a href="#">Bài viết nháp</a>
                        <hr class="dropdown-divider">
                        <a href="#">Tuỳ chọn thông báo</a>
                        <a href="#">Thay đổi mật khẩu</a>
                        <a href="#">Cài đặt khác</a>
                        <hr class="dropdown-divider">
                        <a href="#" id="toggle-theme-btn">Giao diện: Sáng</a>
                        <form method="POST" action="{{ route('logout') }}" style="margin:0;">
                            @csrf
                            <button type="submit" class="dropdown-logout">Đăng xuất</button>
                        </form>
                    </div>
                @else
                    <button class="user-menu-btn">
                        <i class="fas fa-user-circle"></i>
                        <i class="fas fa-caret-down"></i>
                    </button>
                    <div class="user-dropdown">
                        <a href="{{ route('login') }}">Đăng nhập tài khoản</a>
                        <a href="{{ route('register') }}">Đăng ký tài khoản mới</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
    <nav class="tt-header-menu">
        <a href="{{ route('home') }}" class="active">Home</a>
        @foreach ($tags as $tag)
            <a href="#">#{{ $tag->name }}</a>
        @endforeach
    </nav>
</header>

<style>
    .tt-header {
        background: #fff;
        border-bottom: 1px solid #eee;
    }

    .tt-header-top {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 32px;
    }

    .tt-logo {
        display: flex;
        align-items: center;
    }

    .tt-logo-img {
        width: 120px;
        height: 120px;
        border-radius: 8px;
        margin-right: 12px;
    }

    .tt-logo-text {
        font-size: 1.5rem;
        font-weight: bold;
        color: #2563eb;
        text-decoration: none;
    }

    .tt-logo a {
        text-decoration: none;
    }

    .tt-search {
        width: 520px;
        max-width: 100%;
        margin: 0 8px;
        margin-right: 20%;

    }

    .tt-search input {
        width: 100%;
        padding: 10px 18px;
        border-radius: 22px;
        border: none;
        background: #f2f3f7;
        font-size: 1rem;
    }

    .tt-header-actions {
        display: flex;
        align-items: center;
        gap: 16px;
    }

    .tt-btn-share {
        background: #2563eb;
        color: #fff;
        padding: 8px 22px;
        border-radius: 22px;
        font-weight: 600;
        text-decoration: none;
    }

    .tt-icon {
        background: #f2f3f7;
        border-radius: 50%;
        width: 38px;
        height: 38px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: #222;
        font-size: 1.2rem;
    }

    .tt-avatar img {
        width: 38px;
        height: 38px;
        border-radius: 50%;
    }

    .tt-header-menu {
        display: flex;
        align-items: center;
        gap: 24px;
        padding: 0 32px 8px 132px;
        border-bottom: 1px solid #eee;
        margin-top: 12px;
    }

    .tt-header-menu a {
        color: #222;
        text-decoration: none;
        font-size: 1.08rem;
        padding: 4px 0;
        position: relative;
    }

    .tt-header-menu a.active {
        color: #2563eb;
        font-weight: 600;
    }

    .tt-header-menu a.active::after {
        content: '';
        display: block;
        height: 3px;
        background: #2563eb;
        border-radius: 2px;
        width: 100%;
        position: absolute;
        left: 0;
        bottom: -8px;
    }

    .user-menu {
        position: relative;
        display: inline-block;
    }

    .user-menu-btn {
        background: none;
        border: none;
        cursor: pointer;
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 1.2rem;
        color: #6c47d6;
        padding: 6px 10px;
        border-radius: 20px;
        transition: background 0.2s;
    }

    .user-menu-btn:hover {
        background: #f3f0fa;
    }

    .user-dropdown {
        display: none;
        position: absolute;
        right: 0;
        top: 110%;
        background: #fff;
        min-width: 240px;
        box-shadow: 0 8px 32px rgba(80, 80, 160, 0.13);
        border-radius: 14px;
        z-index: 100;
        padding: 8px 0;
        overflow: hidden;
        box-sizing: border-box;
        animation: fadeIn 0.2s;
    }

    .user-menu.open .user-dropdown {
        display: block;
    }

    .user-dropdown a,
    .dropdown-logout {
        display: flex;
        align-items: center;
        gap: 12px;
        width: 100%;
        margin: 0;
        box-sizing: border-box;
        border-radius: 0;
        padding-left: 22px;
        padding-right: 22px;
        color: #222;
        text-decoration: none;
        background: none;
        border: none;
        text-align: left;
        font-size: 1.07rem;
        cursor: pointer;
        transition: background 0.2s, color 0.2s;
    }

    .user-dropdown a:first-child,
    .dropdown-logout:first-child {
        border-top-left-radius: 14px;
        border-top-right-radius: 14px;
    }

    .user-dropdown a:last-of-type,
    .dropdown-logout:last-of-type {
        border-bottom-left-radius: 14px;
        border-bottom-right-radius: 14px;
    }

    .dropdown-logout {
        color: #e53e3e;
        font-weight: 600;
        background: none;
        border: none;
        outline: none;
        margin-top: 2px;
        margin-bottom: 2px;
        box-shadow: none;
    }

    .user-dropdown a:hover,
    .dropdown-logout:hover {
        background: #fbeaea;
        color: #b91c1c;
    }

    .dropdown-divider {
        border: none;
        border-top: 1px solid #f0e9ff;
        margin: 4px 0;
    }

    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.user-menu').forEach(function(userMenu) {
            const btn = userMenu.querySelector('.user-menu-btn');
            const dropdown = userMenu.querySelector('.user-dropdown');
            if (btn && dropdown) {
                btn.addEventListener('click', function(e) {
                    e.stopPropagation();
                    userMenu.classList.toggle('open');
                });
            }
        });
        document.addEventListener('click', function() {
            document.querySelectorAll('.user-menu.open').forEach(function(menu) {
                menu.classList.remove('open');
            });
        });
        const themeBtn = document.getElementById('toggle-theme-btn');
        if (localStorage.getItem('theme') === 'dark') {
            document.body.classList.add('dark-mode');
        }
        if (themeBtn) {
            themeBtn.addEventListener('click', function(e) {
                e.preventDefault();
                document.body.classList.toggle('dark-mode');
                if (document.body.classList.contains('dark-mode')) {
                    localStorage.setItem('theme', 'dark');
                    themeBtn.innerHTML = 'Giao diện: Tối';
                } else {
                    localStorage.setItem('theme', 'light');
                    themeBtn.innerHTML = 'Giao diện: Sáng';
                }
            });
            if (document.body.classList.contains('dark-mode')) {
                themeBtn.innerHTML = 'Giao diện: Tối';
            } else {
                themeBtn.innerHTML = 'Giao diện: Sáng';
            }
        }
        // Reset theme về sáng nếu chưa đăng nhập
        if (!{{ Auth::check() ? 'true' : 'false' }}) {
            localStorage.setItem('theme', 'light');
            document.body.classList.remove('dark-mode');
        }
        // Reset theme khi submit form logout
        const logoutForm = document.querySelector('form[action="{{ route('logout') }}"]');
        if (logoutForm) {
            logoutForm.addEventListener('submit', function() {
                localStorage.setItem('theme', 'light');
                document.body.classList.remove('dark-mode');
            });
        }
    });
</script>
