    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Quản lý danh mục</h1>
            @can('manage-categories')
                <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                    <i class="fas fa-plus"></i> Thêm danh mục
                </a>
            @endcan
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

        <!-- Categories Table -->
        <div class="card shadow-lg mb-4" style="border-radius: 1.5rem;">
            <div class="card-header bg-gradient-primary text-white text-center"
                style="border-radius: 1.5rem 1.5rem 0 0; font-size: 1.2rem; font-weight: 600;">
                <i class="fas fa-table mr-2"></i>Danh sách danh mục
            </div>
            <div class="card-body p-4">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover align-middle" width="100%" cellspacing="0"
                        style="background: #fff;">
                        <thead class="thead-light">
                            <tr class="text-center">
                                <th style="width: 60px;">STT</th>
                                <th style="min-width: 180px;">Tên danh mục</th>
                                <th style="min-width: 200px;">Mô tả</th>
                                @if (auth()->user() && auth()->user()->isAdmin())
                                    <th style="width: 140px;">Thao tác</th>
                                @endif
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($categories as $category)
                                <tr>
                                    <td class="text-center">{{ $loop->iteration }}</td>
                                    <td class="font-weight-bold">{{ $category->name }}</td>
                                    <td>{{ Str::limit($category->description, 60) }}</td>
                                    @if (auth()->user() && auth()->user()->isAdmin())
                                        <td class="text-center">
                                            <a href="{{ route('admin.categories.edit', $category) }}"
                                                class="btn btn-sm btn-warning mr-1" title="Sửa"><i
                                                    class="fas fa-edit"></i></a>
                                            <form action="{{ route('admin.categories.destroy', $category) }}"
                                                method="POST" style="display:inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm btn-danger" title="Xóa"
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
