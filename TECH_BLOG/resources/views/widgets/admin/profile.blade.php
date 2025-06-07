


    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Thông tin cá nhân</h1>
        </div>

        <div class="row">
            <div class="col-lg-8">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Cập nhật thông tin</h6>
                    </div>
                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif

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

                        <form action="{{ route('admin.profile.update') }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="display_name">Tên hiển thị</label>
                                <input type="text" class="form-control @error('display_name') is-invalid @enderror"
                                    id="display_name" name="display_name"
                                    value="{{ old('display_name', $user->display_name) }}" required>
                                @error('display_name')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" class="form-control @error('email') is-invalid @enderror"
                                    id="email" name="email" value="{{ old('email', $user->email) }}" required>
                                @error('email')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="bio">Giới thiệu</label>
                                <textarea class="form-control @error('bio') is-invalid @enderror" id="bio" name="bio" rows="3">{{ old('bio', $user->bio) }}</textarea>
                                @error('bio')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="website">Website</label>
                                <input type="url" class="form-control @error('website') is-invalid @enderror"
                                    id="website" name="website" value="{{ old('website', $user->website) }}">
                                @error('website')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <hr class="my-4">
                            <h6 class="mb-3">Đổi mật khẩu</h6>

                            <div class="form-group">
                                <label for="current_password">Mật khẩu hiện tại</label>
                                <input type="password" class="form-control @error('current_password') is-invalid @enderror"
                                    id="current_password" name="current_password">
                                @error('current_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password">Mật khẩu mới</label>
                                <input type="password" class="form-control @error('new_password') is-invalid @enderror"
                                    id="new_password" name="new_password">
                                @error('new_password')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="new_password_confirmation">Xác nhận mật khẩu mới</label>
                                <input type="password" class="form-control" id="new_password_confirmation"
                                    name="new_password_confirmation">
                            </div>

                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save mr-1"></i> Cập nhật
                            </button>
                        </form>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Thông tin tài khoản</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center mb-4">
                            <img class="img-profile rounded-circle"
                                src="{{ $user->avatar_url ?? asset('img/undraw_profile.svg') }}" style="width: 150px;">
                        </div>
                        <div class="mb-3">
                            <strong>Tên đăng nhập:</strong> {{ $user->username }}
                        </div>
                        <div class="mb-3">
                            <strong>Tên hiển thị:</strong> {{ $user->display_name }}
                        </div>
                        <div class="mb-3">
                            <strong>Email:</strong> {{ $user->email }}
                        </div>
                        <div class="mb-3">
                            <strong>Vai trò:</strong>
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
                        <div class="mb-3">
                            <strong>Ngày tham gia:</strong> {{ date('d/m/Y', strtotime($user->created_at)) }}
                        </div>
                        @if ($user->last_login)
                            <div class="mb-3">
                                <strong>Đăng nhập cuối:</strong> {{ date('d/m/Y H:i', strtotime($user->last_login)) }}
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>


@push('scripts')
    <script>
        // Tự động đóng alert sau 5 giây
        window.setTimeout(function() {
            $(".alert").fadeTo(500, 0).slideUp(500, function() {
                $(this).remove();
            });
        }, 5000);
    </script>
@endpush
