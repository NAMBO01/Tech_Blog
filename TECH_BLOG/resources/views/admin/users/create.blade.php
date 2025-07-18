@extends('template.template_admin')
@section('main-content')
    <style>
        body {
            background: linear-gradient(135deg, #f8fafc 0%, #e9eafc 100%);
            font-family: 'Nunito', Arial, sans-serif;
        }

        .user-form-card {
            border-radius: 1.5rem;
            box-shadow: 0 8px 32px rgba(106, 17, 203, 0.10);
            border: none;
            max-width: 480px;
            margin: 0 auto;
            margin-top: 2.5rem;
            background: rgba(255, 255, 255, 0.95);
            padding: 2.5rem 2rem 2rem 2rem;
        }

        .user-form-label {
            font-size: 0.98rem;
            color: #7b8190;
            font-weight: 600;
            margin-bottom: 0.25rem;
            letter-spacing: 0.01em;
        }

        .user-form-input,
        .input-group .form-control,
        select.user-form-input {
            font-size: 1.13rem;
            border-radius: 1.5rem !important;
            padding: 0.7rem 1.1rem 0.7rem 2.5rem;
            border: 1.5px solid #e3e6f0;
            background: #f8f9fc;
            transition: border-color 0.2s, box-shadow 0.2s;
            box-shadow: 0 1px 2px rgba(106, 17, 203, 0.03);
        }

        .user-form-input:focus {
            border-color: #6a11cb;
            box-shadow: 0 0 0 0.15rem rgba(106, 17, 203, .10);
            background: #fff;
        }

        .input-group {
            position: relative;
        }

        .input-group .input-icon {
            position: absolute;
            left: 0.9rem;
            top: 50%;
            transform: translateY(-50%);
            color: #6a11cb;
            font-size: 1.15em;
            opacity: 0.7;
        }

        select.user-form-input {
            appearance: none;
            -webkit-appearance: none;
            -moz-appearance: none;
            background: #f8f9fc url('data:image/svg+xml;utf8,<svg fill="%236a11cb" height="20" viewBox="0 0 20 20" width="20" xmlns="http://www.w3.org/2000/svg"><path d="M7.293 7.293a1 1 0 011.414 0L10 8.586l1.293-1.293a1 1 0 111.414 1.414l-2 2a1 1 0 01-1.414 0l-2-2a1 1 0 010-1.414z"/></svg>') no-repeat right 1.2rem center/1.2em 1.2em;
            padding-right: 2.8rem;
            border: 1.5px solid #e3e6f0;
            color: #6c757d;
            height: 48px;
            line-height: 1.5;
            font-size: 1.13rem;
            border-radius: 1.5rem !important;
            transition: border-color 0.2s, box-shadow 0.2s;
        }

        select.user-form-input:focus {
            border-color: #6a11cb;
            background-color: #fff;
            outline: none;
        }

        /* Ẩn mũi tên mặc định trên IE */
        select.user-form-input::-ms-expand {
            display: none;
        }

        /* Đảm bảo chữ căn giữa dọc */
        select.user-form-input option {
            padding: 0.7rem 1.1rem;
        }

        .btn-gradient,
        .btn-cancel {
            border-radius: 1.5rem !important;
            font-size: 1.1rem;
        }

        .btn-gradient {
            background: linear-gradient(90deg, #6a11cb 0%, #2575fc 100%);
            color: #fff;
            font-weight: 700;
            border: none;
            padding: 0.7em 2.2em;
            box-shadow: 0 2px 8px rgba(37, 117, 252, 0.10);
            transition: background 0.2s, box-shadow 0.2s;
            margin-right: 0.5rem;
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
            font-weight: 600;
            padding: 0.7em 1.6em;
            transition: background 0.2s;
        }

        .btn-cancel:hover {
            background: #d1d5db;
        }

        @media (max-width: 767.98px) {
            .user-form-card {
                border-radius: 1rem;
                margin-top: 1rem;
                padding: 1.2rem 0.5rem;
            }

            .user-form-input,
            .input-group .form-control,
            select.user-form-input {
                font-size: 1rem;
                padding: 0.5rem 0.8rem 0.5rem 2.2rem;
                border-radius: 1rem !important;
            }

            .btn-gradient,
            .btn-cancel {
                border-radius: 1rem !important;
            }
        }
    </style>

    <body id="page-top">
        <!-- Page Wrapper -->
        <div id="wrapper">
            @include('widgets.admin.sidebar')

            <!-- Content Wrapper -->
            <div id="content-wrapper" class="d-flex flex-column">
                <!-- Main Content -->
                <div id="content">
                    @include('widgets.admin.header')
                    <div class="container-fluid">
                        <h1 class="h3 mb-4 text-gray-800 text-center" style="font-weight:800;letter-spacing:0.01em;">Thêm
                            người dùng mới</h1>
                        <div class="card user-form-card">
                            <form action="{{ route('admin.users.store') }}" method="POST">
                                @csrf
                                <div class="form-group">
                                    <label for="name" class="user-form-label">Tên</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-user"></i></span>
                                        <input type="text" class="form-control user-form-input" id="name"
                                            name="name" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="email" class="user-form-label">Email</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-envelope"></i></span>
                                        <input type="email" class="form-control user-form-input" id="email"
                                            name="email" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="password" class="user-form-label">Mật khẩu</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-lock"></i></span>
                                        <input type="password" class="form-control user-form-input" id="password"
                                            name="password" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="role" class="user-form-label">Vai trò</label>
                                    <div class="input-group">
                                        <span class="input-icon"><i class="fas fa-user-tag"></i></span>
                                        <select class="form-control user-form-input" id="role" name="role" required>
                                            <option value="admin">Quản trị viên</option>
                                            <option value="author">Tác giả</option>
                                            <option value="user">Đọc giả</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="text-center mt-4">
                                    <button type="submit" class="btn btn-gradient">Lưu</button>
                                    <a href="{{ route('admin.users.index') }}" class="btn btn-cancel ml-2">Quay lại</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
    </body>
@endsection
