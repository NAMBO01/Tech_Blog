@extends('template.template_admin')

@section('main-content')

    <body class="bg-gradient-primary">
        <div class="container">
            <!-- Outer Row -->
            <div class="row justify-content-center">
                <div class="col-xl-10 col-lg-12 col-md-9">
                    <div class="card o-hidden border-0 shadow-lg my-5">
                        <div class="card-body p-0">
                            <!-- Nested Row within Card Body -->
                            <div class="row">
                                <div class="col-lg-6 d-none d-lg-block bg-login-image"></div>
                                <div class="col-lg-6">
                                    <div class="p-5">
                                        <div class="text-center">
                                            <h1 class="h4 text-gray-900 mb-4">Chào mừng trở lại!</h1>
                                        </div>
                                        @if (session('success'))
                                            <div class="alert alert-success">
                                                {{ session('success') }}
                                            </div>
                                        @endif
                                        @if (session('error'))
                                            <div class="alert alert-danger">
                                                {{ session('error') }}
                                            </div>
                                        @endif
                                        @if ($errors->any())
                                            <div class="alert alert-danger">
                                                <ul>
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endif
                                        <form class="user" method="POST" action="{{ route('admin.login') }}">
                                            @csrf
                                            <div class="form-group">
                                                <input type="email" class="form-control form-control-user" name="email"
                                                    id="exampleInputEmail" aria-describedby="emailHelp"
                                                    placeholder="Nhập địa chỉ email..." value="{{ old('email') }}">
                                            </div>
                                            <div class="form-group">
                                                <input type="password" class="form-control form-control-user"
                                                    name="password" id="exampleInputPassword" placeholder="Mật khẩu">
                                            </div>
                                            <div class="form-group">
                                                <div class="custom-control custom-checkbox small">
                                                    <input type="checkbox" class="custom-control-input" id="customCheck"
                                                        name="remember">
                                                    <label class="custom-control-label" for="customCheck">Ghi nhớ đăng
                                                        nhập</label>
                                                </div>
                                            </div>
                                            <button type="submit" class="btn btn-primary btn-user btn-block">
                                                Đăng nhập
                                            </button>
                                        </form>
                                        <hr>
                                        <a href="{{ route('auth.google') }}" class="btn btn-google btn-user btn-block">
                                            <i class="fab fa-google fa-fw"></i> Đăng nhập bằng Google
                                        </a>
                                        <a href="{{ route('auth.facebook') }}" class="btn btn-facebook btn-user btn-block">
                                            <i class="fab fa-facebook-f fa-fw"></i> Đăng nhập bằng Facebook
                                        </a>
                                        <hr>
                                        <div class="text-center">
                                            <a class="small" href="#">Quên mật khẩu?</a>
                                        </div>
                                        <div class="text-center">
                                            <a class="small" href="#">Tạo tài khoản mới!</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Bootstrap core JavaScript-->
        <script src="{{ asset('admin_page/vendor/jquery/jquery.min.js') }}"></script>
        <script src="{{ asset('admin_page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

        <!-- Core plugin JavaScript-->
        <script src="{{ asset('admin_page/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

        <!-- Custom scripts for all pages-->
        <script src="{{ asset('admin_page/js/sb-admin-2.min.js') }}"></script>
    </body>
@endsection
