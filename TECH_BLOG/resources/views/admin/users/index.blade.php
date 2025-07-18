@extends('template.template_admin')

@section('main-content')

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
                        <h1 class="h3 mb-4 text-gray-800">Danh sách người dùng</h1>
                        <a href="{{ route('admin.users.create') }}" class="btn btn-gradient mb-3"><i
                                class="fas fa-user-plus mr-1"></i> Thêm
                            người dùng</a>
                        @if (session('success'))
                            <div class="alert alert-success">{{ session('success') }}</div>
                        @endif
                        @if (session('error'))
                            <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif
                        <div class="card user-table-card mb-4">
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table user-table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>STT</th>
                                                <th>Tên</th>
                                                <th>Email</th>
                                                <th>Vai trò</th>
                                                <th>Hành động</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($users as $user)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>{{ $user->username }}</td>
                                                    <td>{{ $user->email }}</td>
                                                    <td>
                                                        @if ($user->role == 'admin')
                                                            <span class="badge badge-role-admin">Admin</span>
                                                        @elseif($user->role == 'author')
                                                            <span class="badge badge-role-author">Tác giả</span>
                                                        @else
                                                            <span class="badge badge-role-user">Đọc giả</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                                            class="btn btn-action btn-warning" title="Sửa"><i
                                                                class="fas fa-edit"></i></a>
                                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                                            method="POST" style="display:inline-block">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" class="btn btn-action btn-danger"
                                                                title="Xóa"
                                                                onclick="return confirm('Xóa người dùng này?')"><i
                                                                    class="fas fa-trash"></i></button>
                                                        </form>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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

<style>
    .user-table-card {
        border-radius: 1.2rem;
        box-shadow: 0 4px 24px rgba(37, 117, 252, 0.08);
        border: none;
    }

    .user-table th {
        background: linear-gradient(90deg, #11998e 0%, #6a11cb 100%);
        color: #fff;
        font-weight: 600;
        border-top-left-radius: 1.2rem;
        border-top-right-radius: 1.2rem;
        font-size: 1.08rem;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.12);
    }

    .user-table td,
    .user-table th {
        vertical-align: middle;
    }

    .badge-role-admin {
        background: linear-gradient(90deg, #ff512f 0%, #f09819 100%);
        color: #fff;
        font-weight: 600;
        border-radius: 1rem;
        padding: 0.4em 1em;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
    }

    .badge-role-author {
        background: linear-gradient(90deg, #11998e 0%, #0575e6 100%);
        color: #fff;
        font-weight: 600;
        border-radius: 1rem;
        padding: 0.4em 1em;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
    }

    .badge-role-user {
        background: linear-gradient(90deg, #a770ef 0%, #5f72bd 100%);
        color: #fff;
        font-weight: 600;
        border-radius: 1rem;
        padding: 0.4em 1em;
        text-shadow: 0 1px 2px rgba(0, 0, 0, 0.15);
    }

    .btn-gradient {
        background: linear-gradient(90deg, #11998e 0%, #6a11cb 100%);
        color: #fff;
        font-weight: 600;
        border: none;
        border-radius: 2rem;
        padding: 0.6em 1.6em;
        box-shadow: 0 2px 8px rgba(37, 117, 252, 0.10);
        transition: background 0.2s, box-shadow 0.2s;
    }

    .btn-gradient:hover {
        background: linear-gradient(90deg, #6a11cb 0%, #11998e 100%);
        color: #fff;
        box-shadow: 0 4px 16px rgba(37, 117, 252, 0.16);
    }

    .btn-action {
        border-radius: 50%;
        width: 2.2em;
        height: 2.2em;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        font-size: 1.1em;
        margin-right: 0.2em;
    }

    .btn-action.btn-warning {
        color: #fff;
        background: #f6c23e;
        border: none;
    }

    .btn-action.btn-danger {
        color: #fff;
        background: #e74a3b;
        border: none;
    }

    .btn-action:hover {
        filter: brightness(1.1);
    }

    @media (max-width: 767.98px) {
        .user-table-card {
            border-radius: 0.7rem;
        }

        .user-table th,
        .user-table td {
            font-size: 0.97rem;
        }
    }
</style>
<script>
    setTimeout(function() {
        document.querySelectorAll('.alert').forEach(e => e.remove());
    }, 3000);
</script>
<script src="{{ asset('admin_page/js/demo/datatables-demo.js') }}"></script>
