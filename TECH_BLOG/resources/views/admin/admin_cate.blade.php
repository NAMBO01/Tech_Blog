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

                    <!-- Begin Page Content -->
                    <div class="container-fluid">
                        <div class="card shadow-lg mb-4" style="border-radius: 1.5rem;">
                            <div class="card-header bg-gradient-primary text-white text-center"
                                style="border-radius: 1.5rem 1.5rem 0 0; font-size: 1.2rem; font-weight: 600;">
                                <i class="fas fa-list-alt mr-2"></i>Quản lý danh mục
                                @if (auth()->user() && auth()->user()->isAdmin())
                                    <a href="{{ route('admin.categories.create') }}" class="btn btn-primary float-right"
                                        style="border-radius: 0.75rem; font-weight: 600;">
                                        <i class="fas fa-plus-circle mr-1"></i> Thêm danh mục
                                    </a>
                                @endif
                            </div>
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle" width="100%"
                                        cellspacing="0" style="background: #fff;">
                                        <thead class="thead-light">
                                            <tr class="text-center">
                                                <th style="width: 60px;">ID</th>
                                                <th style="min-width: 150px;">Tên</th>

                                                <th style="min-width: 120px;">Slug</th>
                                                <th style="min-width: 120px;">Danh mục cha</th>
                                                <th style="min-width: 120px;">Lĩnh vực</th>
                                                <th style="min-width: 200px;">Mô tả</th>
                                                <th style="min-width: 120px;">Ngày tạo</th>
                                                @if (auth()->user() && auth()->user()->isAdmin())
                                                    <th style="width: 120px;">Thao tác</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($categories as $category)
                                                <tr>
                                                    <td class="text-center">{{ $category->id }}</td>
                                                    <td class="font-weight-bold">{{ $category->name }}</td>
                                                    <

                                                    <td>{{ $category->slug }}</td>
                                                    <td>{{ $category->parent ? $category->parent->name : 'Không có' }}</td>
                                                    <td>{{ $category->field ? $category->field->name : 'Không có' }}</td>
                                                    <td>{{ Str::limit($category->description, 60) }}</td>
                                                    <td>{{ $category->created_at->format('d/m/Y H:i') }}</td>
                                                    @if (auth()->user() && auth()->user()->isAdmin())
                                                        <td class="text-center">
                                                            <a href="{{ route('admin.categories.edit', $category->id) }}"
                                                                class="btn btn-sm btn-warning mr-1" title="Sửa"
                                                                style="border-radius: 0.5rem;"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <form
                                                                action="{{ route('admin.categories.destroy', $category->id) }}"
                                                                method="POST" style="display:inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    title="Xóa" style="border-radius: 0.5rem;"
                                                                    onclick="return confirm('Bạn có chắc muốn xóa?')"><i
                                                                        class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- End of Main Content -->
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->
        </div>
    </body>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                "language": {
                    "url": "//cdn.datatables.net/plug-ins/1.10.24/i18n/Vietnamese.json"
                }
            });

            // Xử lý xóa danh mục
            $('.delete-form').on('submit', function(e) {
                e.preventDefault();
                var form = $(this);

                Swal.fire({
                    title: 'Bạn có chắc chắn?',
                    text: "Bạn không thể hoàn tác sau khi xóa!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Có, xóa nó!',
                    cancelButtonText: 'Hủy'
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });

            // Tự động đóng thông báo sau 5 giây
            setTimeout(function() {
                $('.alert').alert('close');
            }, 5000);
        });
    </script>
@endsection
