<!-- Sidebar -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
    <!-- Sidebar - Brand -->
    <a class="sidebar-brand d-flex align-items-center justify-content-center" href="{{ route('admin.dashboard') }}">
        <div class="sidebar-brand-icon rotate-n-15">
            <i class="fas fa-laugh-wink"></i>
        </div>
        <div class="sidebar-brand-text mx-3">TECH BLOG <span class="sidebar-admin">ADMIN</span></div>
    </a>
    <hr class="sidebar-divider my-0">
    <!-- Nav Item - Dashboard -->
    <li class="nav-item active">
        <a class="nav-link" href="{{ route('admin.dashboard') }}">
            <i class="fas fa-fw fa-tachometer-alt"></i>
            <span>Bảng điều khiển</span></a>
    </li>
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Quản lý</div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseTwo"
            aria-expanded="true" aria-controls="collapseTwo">
            <i class="fas fa-fw fa-cog"></i>
            <span>Quản lý</span>
        </a>
        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <a class="collapse-item" href="{{ route('admin.post_admin') }}">Danh sách bài viết</a>
                <a class="collapse-item" href="{{ route('admin.posts.create') }}">Thêm bài viết mới</a>
                <a class="collapse-item" href="{{ route('admin.admin_cate') }}">Danh mục</a>
                <a class="collapse-item" href="{{ route('admin.fields.index') }}">Lĩnh vực</a>
                <a class="collapse-item" href="{{ route('admin.tags.index') }}">Thẻ</a>
            </div>
        </div>
    </li>
    @if (auth()->user() && auth()->user()->isAdmin())
        <li class="nav-item">
            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseUtilities"
                aria-expanded="true" aria-controls="collapseUtilities">
                <i class="fas fa-fw fa-wrench"></i>
                <span>Quản lý người dùng</span>
            </a>
            <div id="collapseUtilities" class="collapse" aria-labelledby="headingUtilities"
                data-parent="#accordionSidebar">
                <div class="bg-white py-2 collapse-inner rounded">
                    <h6 class="collapse-header">Quản lý người dùng:</h6>
                    <a class="collapse-item" href="{{ route('admin.users.index') }}">Danh sách người dùng</a>
                    <a class="collapse-item" href="{{ route('admin.users.create') }}">Thêm người dùng</a>
                    <a class="collapse-item" href="{{ route('admin.users.index') }}">Phân quyền</a>
                </div>
            </div>
        </li>
    @endif
    <hr class="sidebar-divider">
    <div class="sidebar-heading">Cài đặt</div>
    <li class="nav-item">
        <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapsePages"
            aria-expanded="true" aria-controls="collapsePages">
            <i class="fas fa-fw fa-folder"></i>
            <span>Cài đặt hệ thống</span>
        </a>
        <div id="collapsePages" class="collapse" aria-labelledby="headingPages" data-parent="#accordionSidebar">
            <div class="bg-white py-2 collapse-inner rounded">
                <h6 class="collapse-header">Cài đặt chung:</h6>
                <a class="collapse-item" href="#">Thông tin website</a>
                <a class="collapse-item" href="#">Cấu hình SEO</a>
                <a class="collapse-item" href="#">Backup dữ liệu</a>
            </div>
        </div>
    </li>
    <hr class="sidebar-divider d-none d-md-block">
    <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
    </div>
    <div class="sidebar-card d-none d-lg-flex">
        <img class="sidebar-card-illustration mb-2" src="{{ asset('admin_page/img/undraw_rocket.svg') }}"
            alt="...">
        <p class="text-center mb-2"><strong>SB Admin Pro</strong> is packed with premium features, components, and more!
        </p>
        <a class="btn btn-success btn-sm" href="https://startbootstrap.com/theme/sb-admin-pro">Upgrade to Pro!</a>
    </div>
</ul>
<!-- End of Sidebar -->
<style>
    .sidebar-admin {
        font-size: 0.7em;
        vertical-align: super;
        letter-spacing: 1px;
        margin-left: 2px;
        font-weight: 600;
    }
</style>
