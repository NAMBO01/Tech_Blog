<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Thông tin cá nhân</h1>
        <button id="edit-profile-btn" class="btn btn-primary d-none d-md-inline-block"><i
                class="fas fa-user-edit mr-1"></i> Chỉnh sửa</button>
    </div>

    @if ($errors->any())
        <div class="alert alert-danger alert-dismissible fade show" role="alert">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    <div class="row justify-content-center">
        <div class="col-lg-8 col-md-10 col-12">
            <div id="edit-form-card" class="card shadow mb-4" style="display: none;">
                <div class="card-header py-3">
                    <h6 class="m-0">Cập nhật thông tin</h6>
                </div>
                <div class="card-body">
                    @if ($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <ul class="mb-0">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    @endif

                    <form action="{{ route('admin.profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="avatar-upload-wrapper">
                            <img id="avatar_preview" class="avatar-upload-preview"
                                src="{{ $user->avatar_url ?? asset('admin_page/img/undraw_profile.svg') }}">
                            <label for="avatar" class="avatar-upload-label">
                                <i class="fas fa-camera"></i> Chọn ảnh đại diện
                            </label>
                            <input type="file" id="avatar" name="avatar" accept="image/*">
                            <div id="avatar-filename" class="avatar-upload-filename"></div>
                        </div>

                        <div class="edit-form-group">
                            <label for="display_name" class="edit-form-label">Tên hiển thị</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-id-badge text-gradient"></i></span>
                                <input type="text"
                                    class="form-control edit-form-input @error('display_name') is-invalid @enderror"
                                    id="display_name" name="display_name"
                                    value="{{ old('display_name', $user->display_name) }}" required>
                            </div>
                            @error('display_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="edit-form-group">
                            <label for="email" class="edit-form-label">Email</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-envelope text-gradient"></i></span>
                                <input type="email"
                                    class="form-control edit-form-input @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}" required>
                            </div>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="edit-form-group">
                            <label for="bio" class="edit-form-label">Giới thiệu</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-info-circle text-gradient"></i></span>
                                <textarea class="form-control edit-form-input @error('bio') is-invalid @enderror" id="bio" name="bio"
                                    rows="3">{{ old('bio', $user->bio) }}</textarea>
                            </div>
                            @error('bio')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="edit-form-group">
                            <label for="website" class="edit-form-label">Website</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-globe text-gradient"></i></span>
                                <input type="url"
                                    class="form-control edit-form-input @error('website') is-invalid @enderror"
                                    id="website" name="website" value="{{ old('website', $user->website) }}">
                            </div>
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <hr class="my-4">
                        <h6 class="mb-3">Đổi mật khẩu</h6>

                        <div class="edit-form-group">
                            <label for="current_password" class="edit-form-label">Mật khẩu hiện tại</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-lock text-gradient"></i></span>
                                <input type="password"
                                    class="form-control edit-form-input @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password">
                                <span class="input-group-text">
                                    <button class="toggle-password" type="button" data-target="current_password"
                                        tabindex="-1"><i class="fas fa-eye"></i></button>
                                </span>
                            </div>
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="edit-form-group">
                            <label for="new_password" class="edit-form-label">Mật khẩu mới</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key text-gradient"></i></span>
                                <input type="password"
                                    class="form-control edit-form-input @error('new_password') is-invalid @enderror"
                                    id="new_password" name="new_password">
                                <span class="input-group-text">
                                    <button class="toggle-password" type="button" data-target="new_password"
                                        tabindex="-1"><i class="fas fa-eye"></i></button>
                                </span>
                            </div>
                            <div id="password-strength">
                                <div id="password-strength-bar"></div>
                            </div>
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="edit-form-group">
                            <label for="new_password_confirmation" class="edit-form-label">Xác nhận mật khẩu
                                mới</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="fas fa-key text-gradient"></i></span>
                                <input type="password" class="form-control edit-form-input"
                                    id="new_password_confirmation" name="new_password_confirmation">
                                <span class="input-group-text">
                                    <button class="toggle-password" type="button"
                                        data-target="new_password_confirmation" tabindex="-1"><i
                                            class="fas fa-eye"></i></button>
                                </span>
                                <span id="password-match" class="ml-2"></span>
                            </div>
                        </div>

                        <button type="submit" class="edit-form-btn"><i class="fas fa-save mr-1"></i> Cập
                            nhật</button>
                        <button type="button" class="edit-form-btn-cancel" id="cancel-edit-btn">Hủy</button>
                    </form>
                </div>
            </div>

            <div id="profile-info-card" class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Thông tin tài khoản</h6>
                </div>
                <div class="card-body">
                    <div class="row align-items-center">
                        <div class="col-md-4 text-center mb-3 mb-md-0">
                            <img class="img-profile rounded-circle"
                                src="{{ $user->avatar_url ?? asset('admin_page/img/undraw_profile.svg') }}"
                                style="width: 150px; height: 150px; object-fit: cover;">
                        </div>
                        <div class="col-md-8">
                            <div class="profile-info-list">
                                <div class="profile-info-item">
                                    <div class="profile-info-icon"><i class="fas fa-user"></i></div>
                                    <div class="profile-info-content">
                                        <div class="profile-info-label">Tên đăng nhập</div>
                                        <div class="profile-info-value">{{ $user->username }}</div>
                                    </div>
                                </div>
                                <div class="profile-info-item">
                                    <div class="profile-info-icon"><i class="fas fa-id-badge"></i></div>
                                    <div class="profile-info-content">
                                        <div class="profile-info-label">Tên hiển thị</div>
                                        <div class="profile-info-value">{{ $user->display_name }}</div>
                                    </div>
                                </div>
                                <div class="profile-info-item">
                                    <div class="profile-info-icon"><i class="fas fa-envelope"></i></div>
                                    <div class="profile-info-content">
                                        <div class="profile-info-label">Email</div>
                                        <div class="profile-info-value">{{ $user->email }}</div>
                                    </div>
                                </div>
                                <div class="profile-info-item">
                                    <div class="profile-info-icon"><i class="fas fa-info-circle"></i></div>
                                    <div class="profile-info-content">
                                        <div class="profile-info-label">Giới thiệu</div>
                                        <div class="profile-info-value">{{ $user->bio }}</div>
                                    </div>
                                </div>
                                <div class="profile-info-item">
                                    <div class="profile-info-icon"><i class="fas fa-globe"></i></div>
                                    <div class="profile-info-content">
                                        <div class="profile-info-label">Website</div>
                                        <div class="profile-info-value"><a href="{{ $user->website }}"
                                                target="_blank">{{ $user->website }}</a></div>
                                    </div>
                                </div>
                                <div class="profile-info-item">
                                    <div class="profile-info-icon"><i class="fas fa-user-shield"></i></div>
                                    <div class="profile-info-content">
                                        <div class="profile-info-label">Vai trò</div>
                                        <div class="profile-info-value">
                                            @switch($user->role)
                                                @case('admin')
                                                    Quản trị viên
                                                @break

                                                @case('author')
                                                    Tác giả
                                                @break

                                                @default
                                                    Đọc giả
                                            @endswitch
                                        </div>
                                    </div>
                                </div>
                                <div class="profile-info-item">
                                    <div class="profile-info-icon"><i class="fas fa-clock"></i></div>
                                    <div class="profile-info-content">
                                        <div class="profile-info-label">Đăng nhập cuối</div>
                                        <div class="profile-info-value">
                                            @if ($user->last_login)
                                                {{ \Carbon\Carbon::parse($user->last_login)->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}
                                                <small class="text-muted d-block">
                                                    ({{ \Carbon\Carbon::parse($user->last_login)->diffForHumans() }})
                                                </small>
                                            @else
                                                <span class="text-muted">Chưa có</span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    /* Card UI */
    .card {
        border-radius: 1.25rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
        border: none;
        transition: box-shadow 0.3s;
    }

    .card:hover {
        box-shadow: 0 16px 48px 0 rgba(31, 38, 135, 0.25);
    }

    /* Avatar */
    .img-profile,
    #avatar_preview {
        border: 4px solid transparent;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%) border-box;
        box-shadow: 0 4px 24px rgba(106, 17, 203, 0.12);
        padding: 2px;
        transition: box-shadow 0.3s, border-color 0.3s;
    }

    .img-profile:hover,
    #avatar_preview:hover {
        box-shadow: 0 8px 32px rgba(37, 117, 252, 0.18);
        border-color: #2575fc;
    }

    /* Floating label */
    .form-group label {
        font-weight: 500;
        color: #495057;
        margin-bottom: 0.25rem;
    }

    .form-control:focus {
        border-color: #2575fc;
        box-shadow: 0 0 0 0.2rem rgba(37, 117, 252, .15);
    }

    /* Password strength */
    #password-strength {
        height: 7px;
        border-radius: 4px;
        margin-top: 6px;
        background: #e9ecef;
        overflow: hidden;
    }

    #password-strength-bar {
        height: 100%;
        transition: width 0.3s;
    }

    /* Tick for password match */
    #password-match {
        font-size: 1.2em;
        margin-left: 8px;
        vertical-align: middle;
    }

    /* Button */
    .btn-primary {
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(37, 117, 252, 0.08);
        transition: background 0.3s, box-shadow 0.3s;
    }

    .btn-primary:hover {
        background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
        box-shadow: 0 4px 16px rgba(37, 117, 252, 0.16);
    }

    .btn-secondary {
        transition: background 0.3s;
    }

    .btn-secondary:hover {
        background: #e2e6ea;
    }

    /* Responsive */
    @media (max-width: 767.98px) {
        #profile-info-card .row {
            flex-direction: column !important;
        }

        #profile-info-card .img-profile {
            width: 100px !important;
            height: 100px !important;
        }

        .profile-info-item {
            font-size: 1rem;
            padding: 0.6rem 0.7rem;
        }

        .profile-info-item strong {
            min-width: 90px;
        }
    }

    .profile-info-list {
        display: flex;
        flex-direction: column;
        gap: 1.2rem;
    }

    .profile-info-item {
        display: flex;
        align-items: flex-start;
        background: #fff;
        border-radius: 1rem;
        box-shadow: 0 2px 12px 0 rgba(37, 117, 252, 0.07);
        padding: 1.1rem 1.3rem;
        transition: box-shadow 0.2s, transform 0.2s;
        position: relative;
        min-height: 70px;
    }

    .profile-info-item:hover {
        box-shadow: 0 6px 24px 0 rgba(37, 117, 252, 0.13);
        transform: translateY(-2px) scale(1.01);
    }

    .profile-info-icon {
        min-width: 48px;
        min-height: 48px;
        max-width: 48px;
        max-height: 48px;
        border-radius: 50%;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        display: flex;
        align-items: center;
        justify-content: center;
        color: #fff;
        font-size: 1.5rem;
        margin-right: 1.1rem;
        box-shadow: 0 2px 8px rgba(106, 17, 203, 0.10);
    }

    .profile-info-content {
        flex: 1;
        display: flex;
        flex-direction: column;
        justify-content: center;
    }

    .profile-info-label {
        font-size: 0.92rem;
        color: #8a8fa7;
        font-weight: 500;
        margin-bottom: 0.15rem;
        letter-spacing: 0.02em;
    }

    .profile-info-value {
        font-size: 1.18rem;
        color: #222b45;
        font-weight: 600;
        word-break: break-all;
    }

    .profile-info-value a {
        color: #2575fc;
        text-decoration: underline dotted;
        transition: color 0.2s;
    }

    .profile-info-value a:hover {
        color: #6a11cb;
        text-decoration: underline;
    }

    @media (max-width: 767.98px) {
        .profile-info-item {
            padding: 0.8rem 0.7rem;
            min-height: 56px;
        }

        .profile-info-icon {
            min-width: 36px;
            min-height: 36px;
            max-width: 36px;
            max-height: 36px;
            font-size: 1.1rem;
            margin-right: 0.7rem;
        }

        .profile-info-label {
            font-size: 0.85rem;
        }

        .profile-info-value {
            font-size: 1rem;
        }
    }

    /* --- Edit Form UI/UX --- */
    #edit-form-card.card {
        border-radius: 1.25rem;
        box-shadow: 0 8px 32px 0 rgba(31, 38, 135, 0.18);
        border: none;
        padding-bottom: 1.2rem;
    }

    #edit-form-card .card-header {
        border-radius: 1.25rem 1.25rem 0 0;
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        color: #fff;
        font-size: 1.1rem;
        font-weight: 600;
        letter-spacing: 0.5px;
    }

    .edit-form-group {
        margin-bottom: 1.2rem;
    }

    .edit-form-label {
        font-size: 0.97rem;
        color: #8a8fa7;
        font-weight: 500;
        margin-bottom: 0.25rem;
        letter-spacing: 0.02em;
        display: block;
    }

    .edit-form-input {
        font-size: 1.13rem;
        border-radius: 0.7rem;
        padding: 0.7rem 1.1rem;
        border: 1.5px solid #e3e6f0;
        background: #f8f9fc;
        transition: border-color 0.2s, box-shadow 0.2s;
    }

    .edit-form-input:focus {
        border-color: #2575fc;
        box-shadow: 0 0 0 0.15rem rgba(37, 117, 252, .13);
        background: #fff;
    }

    .edit-form-input.is-invalid {
        border-color: #e74c3c;
    }

    .edit-form-icon {
        position: absolute;
        left: 1rem;
        top: 50%;
        transform: translateY(-50%);
        color: #6a11cb;
        font-size: 1.1em;
        opacity: 0.7;
    }

    .edit-form-input-group {
        position: relative;
    }

    #avatar_preview {
        border: 4px solid transparent;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%) border-box;
        box-shadow: 0 4px 24px rgba(106, 17, 203, 0.12);
        padding: 2px;
        width: 120px;
        height: 120px;
        object-fit: cover;
        margin-bottom: 0.5rem;
        transition: box-shadow 0.3s, border-color 0.3s;
    }

    #avatar_preview:hover {
        box-shadow: 0 8px 32px rgba(37, 117, 252, 0.18);
        border-color: #2575fc;
    }

    .edit-form-btn {
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        border: none;
        font-weight: 600;
        letter-spacing: 0.5px;
        box-shadow: 0 2px 8px rgba(37, 117, 252, 0.08);
        transition: background 0.3s, box-shadow 0.3s;
        padding: 0.7rem 2.2rem;
        font-size: 1.1rem;
        border-radius: 0.7rem;
    }

    .edit-form-btn:hover {
        background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
        box-shadow: 0 4px 16px rgba(37, 117, 252, 0.16);
    }

    .edit-form-btn-cancel {
        background: #e2e6ea;
        color: #222b45;
        border: none;
        margin-left: 0.7rem;
        font-weight: 500;
        border-radius: 0.7rem;
        padding: 0.7rem 1.5rem;
        transition: background 0.2s;
    }

    .edit-form-btn-cancel:hover {
        background: #d1d5db;
    }

    @media (max-width: 767.98px) {
        #edit-form-card.card {
            border-radius: 0.7rem;
            padding-bottom: 0.5rem;
        }

        #avatar_preview {
            width: 80px;
            height: 80px;
        }
    }

    .input-group-text .text-gradient {
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .input-group-text {
        background: transparent;
        border: none;
        font-size: 1.2em;
        align-items: center;
    }

    .input-group .form-control.edit-form-input {
        border-radius: 0.7rem;
        font-size: 1.13rem;
        padding-left: 0.75rem;
        padding-right: 0.75rem;
    }

    .input-group .form-control:focus {
        box-shadow: 0 0 0 0.15rem rgba(37, 117, 252, .13);
        border-color: #2575fc;
        background: #fff;
    }

    .input-group .toggle-password {
        color: #6a11cb;
        font-size: 1.1em;
        background: transparent;
        border: none;
        outline: none;
        box-shadow: none;
        padding: 0;
        margin: 0;
    }

    .input-group .toggle-password:focus {
        outline: none;
        box-shadow: none;
    }

    /* Avatar upload UI */
    .avatar-upload-wrapper {
        display: flex;
        flex-direction: column;
        align-items: center;
        margin-bottom: 1.2rem;
        position: relative;
    }

    .avatar-upload-preview {
        width: 130px;
        height: 130px;
        border-radius: 50%;
        border: 4px solid transparent;
        background: linear-gradient(135deg, #6a11cb 0%, #2575fc 100%) border-box;
        box-shadow: 0 4px 24px rgba(106, 17, 203, 0.12);
        object-fit: cover;
        transition: box-shadow 0.3s, border-color 0.3s, filter 0.2s;
        margin-bottom: 0.7rem;
        position: relative;
        z-index: 1;
    }

    .avatar-upload-wrapper:hover .avatar-upload-preview {
        filter: brightness(0.92) blur(1px);
        box-shadow: 0 8px 32px rgba(37, 117, 252, 0.18);
        border-color: #2575fc;
    }

    .avatar-upload-label {
        background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
        color: #fff;
        border-radius: 2rem;
        padding: 0.45rem 1.3rem 0.45rem 1.1rem;
        font-size: 1.05rem;
        font-weight: 500;
        cursor: pointer;
        box-shadow: 0 2px 8px rgba(37, 117, 252, 0.10);
        display: flex;
        align-items: center;
        gap: 0.5rem;
        z-index: 2;
        border: none;
        outline: none;
        transition: background 0.2s, box-shadow 0.2s;
        margin-bottom: 0.2rem;
    }

    .avatar-upload-label:hover {
        background: linear-gradient(90deg, #2575fc 0%, #6a11cb 100%);
        box-shadow: 0 4px 16px rgba(37, 117, 252, 0.16);
    }

    .avatar-upload-label i {
        font-size: 1.2em;
    }

    #avatar {
        display: none;
    }

    .avatar-upload-filename {
        font-size: 0.97rem;
        color: #6a11cb;
        margin-top: 0.3rem;
        text-align: center;
        word-break: break-all;
    }

    @media (max-width: 767.98px) {
        .avatar-upload-preview {
            width: 80px;
            height: 80px;
        }

        .avatar-upload-label {
            font-size: 0.97rem;
            padding: 0.35rem 1rem 0.35rem 0.9rem;
            bottom: 10px;
        }
    }
</style>

@push('scripts')
    <script>
        // Auto-hide alert
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);

        // UI/UX & JS improvements
        document.addEventListener('DOMContentLoaded', function() {
            const editBtn = document.getElementById('edit-profile-btn');
            const cancelBtn = document.getElementById('cancel-edit-btn');
            const editFormCard = document.getElementById('edit-form-card');
            const profileInfoCard = document.getElementById('profile-info-card');
            const form = document.querySelector('form');
            const submitBtn = document.getElementById('submit-btn') || form.querySelector('button[type="submit"]');
            // Password strength & match
            const newPassword = document.getElementById('new_password');
            const confirmPassword = document.getElementById('new_password_confirmation');
            // Add strength indicator
            let strengthDiv = document.createElement('div');
            strengthDiv.className = 'password-strength';
            newPassword && newPassword.parentNode.parentNode.appendChild(strengthDiv);
            // Add match indicator
            let matchDiv = document.createElement('div');
            matchDiv.className = 'password-match';
            confirmPassword && confirmPassword.parentNode.parentNode.appendChild(matchDiv);

            function passwordStrength(pw) {
                let score = 0;
                if (pw.length >= 8) score++;
                if (/[a-z]/.test(pw)) score++;
                if (/[A-Z]/.test(pw)) score++;
                if (/[0-9]/.test(pw)) score++;
                if (/[^A-Za-z0-9]/.test(pw)) score++;
                return score;
            }

            function updateStrength() {
                if (!newPassword) return;
                const val = newPassword.value;
                let score = passwordStrength(val);
                if (!val) {
                    strengthDiv.textContent = '';
                    strengthDiv.className = 'password-strength';
                    return;
                }
                if (score <= 2) {
                    strengthDiv.textContent = 'Yếu';
                    strengthDiv.className = 'password-strength strength-weak';
                } else if (score <= 4) {
                    strengthDiv.textContent = 'Trung bình';
                    strengthDiv.className = 'password-strength strength-medium';
                } else {
                    strengthDiv.textContent = 'Mạnh';
                    strengthDiv.className = 'password-strength strength-strong';
                }
            }

            function updateMatch() {
                if (!confirmPassword) return;
                const pw = newPassword.value,
                    cf = confirmPassword.value;
                if (!cf) {
                    matchDiv.textContent = '';
                    matchDiv.className = 'password-match';
                    return;
                }
                if (pw === cf) {
                    matchDiv.textContent = '✓ Mật khẩu khớp';
                    matchDiv.className = 'password-match match-yes';
                } else {
                    matchDiv.textContent = '✗ Mật khẩu không khớp';
                    matchDiv.className = 'password-match match-no';
                }
            }
            newPassword && newPassword.addEventListener('input', () => {
                updateStrength();
                updateMatch();
            });
            confirmPassword && confirmPassword.addEventListener('input', updateMatch);

            // Toggle form
            if (editBtn) editBtn.addEventListener('click', () => {
                editFormCard.style.display = 'block';
                profileInfoCard.style.display = 'none';
            });
            if (cancelBtn) cancelBtn.addEventListener('click', () => {
                editFormCard.style.display = 'none';
                profileInfoCard.style.display = 'block';
            });

            // Toggle password visibility
            document.querySelectorAll('.toggle-password').forEach(btn => {
                btn.addEventListener('click', function() {
                    const target = document.getElementById(this.getAttribute('data-target'));
                    if (target.type === 'password') {
                        target.type = 'text';
                        this.querySelector('i').classList.remove('fa-eye');
                        this.querySelector('i').classList.add('fa-eye-slash');
                    } else {
                        target.type = 'password';
                        this.querySelector('i').classList.remove('fa-eye-slash');
                        this.querySelector('i').classList.add('fa-eye');
                    }
                });
            });

            // Avatar preview
            const avatarInput = document.getElementById('avatar');
            const avatarPreview = document.getElementById('avatar_preview');
            if (avatarInput) {
                avatarInput.addEventListener('change', function(e) {
                    if (e.target.files && e.target.files[0]) {
                        const reader = new FileReader();
                        reader.onload = function(ev) {
                            avatarPreview.src = ev.target.result;
                        }
                        reader.readAsDataURL(e.target.files[0]);
                    }
                });
            }

            // Loading state on submit
            if (form && submitBtn) {
                form.addEventListener('submit', function() {
                    submitBtn.disabled = true;
                    submitBtn.innerHTML =
                        '<span class="spinner-border spinner-border-sm mr-2"></span>Đang cập nhật...';
                });
            }
        });
    </script>
@endpush
