<div class="container-fluid">
    <!-- Page Heading -->
    <div class="d-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-dark font-weight-bold"><i class="fas fa-newspaper mr-2 text-primary"></i>Quản lý bài viết
        </h1>
        <a href="{{ route('admin.posts.create') }}" class="btn btn-primary shadow-sm">
            <i class="fas fa-plus fa-sm text-white-50"></i> Thêm bài viết mới
        </a>
    </div>

    <div class="card border-0 shadow mb-4">
        <div class="card-header bg-white border-0 py-3 d-flex align-items-center justify-content-between">
            <h6 class="m-0 font-weight-bold text-primary"><i class="fas fa-list mr-2"></i>Danh sách bài viết</h6>
            <!-- Search/Filter có thể thêm ở đây nếu muốn -->
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0" id="dataTable" width="100%">
                    <thead class="thead-light">
                        <tr>
                            <th>STT</th>
                            <th>Ảnh</th>
                            <th>Tiêu đề</th>
                            <th>Danh mục</th>
                            <th>Tác giả</th>
                            <th>Trạng thái</th>
                            <th>Ngày tạo</th>
                            <th>Ngày cập nhật</th>
                            <th>Thao tác</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($posts as $key => $post)
                            <tr>
                                <td>{{ ($posts->currentPage() - 1) * $posts->perPage() + $loop->iteration }}</td>
                                <td>
                                    @if ($post->cover_image_url)
                                        <img src="{{ asset($post->cover_image_url) }}" alt="cover" class="rounded"
                                            style="width: 48px; height: 48px; object-fit: cover; border: 1px solid #e3e6f0;">
                                    @else
                                        <span class="d-inline-block text-secondary" style="font-size: 2rem;"><i
                                                class="fas fa-image"></i></span>
                                    @endif
                                </td>
                                <td class="font-weight-bold text-dark">{{ $post->title }}</td>
                                <td>{{ $post->category->name ?? 'Không có' }}</td>
                                <td>
                                    @if ($post->author && $post->author->avatar_url)
                                        <img src="{{ asset($post->author->avatar_url) }}" alt="avatar"
                                            class="rounded-circle mr-2"
                                            style="width: 32px; height: 32px; object-fit: cover; border: 1px solid #e3e6f0;">
                                    @else
                                        <span class="d-inline-block text-secondary mr-2" style="font-size: 1.2rem;"><i
                                                class="fas fa-user-circle"></i></span>
                                    @endif
                                    <span>{{ $post->author->display_name ?? 'N/A' }}</span>
                                </td>
                                <td>
                                    @if ($post->status == 'published')
                                        <span class="badge badge-success"><i class="fas fa-check-circle mr-1"></i>Đã
                                            xuất bản</span>
                                    @elseif($post->status == 'draft')
                                        <span class="badge badge-warning text-white"><i
                                                class="fas fa-pencil-alt mr-1"></i>Bản nháp</span>
                                    @else
                                        <span class="badge badge-secondary"><i
                                                class="fas fa-clock mr-1"></i>{{ ucfirst($post->status) }}</span>
                                    @endif
                                </td>
                                <td>{{ $post->created_at ? date('d/m/Y H:i', strtotime($post->created_at)) : 'N/A' }}
                                </td>
                                <td>{{ $post->updated_at ? date('d/m/Y H:i', strtotime($post->updated_at)) : 'N/A' }}
                                </td>
                                <td>
                                    <a href="{{ route('admin.posts.revisions', $post->id) }}"
                                        class="btn btn-sm btn-outline-info" data-toggle="tooltip"
                                        title="Xem lịch sử chỉnh sửa">
                                        <i class="fas fa-history"></i>
                                    </a>
                                    @if (auth()->user()->role === 'admin' || (auth()->user()->role === 'author' && $post->author_id === auth()->id()))
                                        <a href="{{ route('admin.posts.edit', $post->id) }}"
                                            class="btn btn-sm btn-outline-primary" data-toggle="tooltip"
                                            title="Sửa bài viết">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <form action="{{ route('admin.posts.destroy', $post->id) }}" method="POST"
                                            class="d-inline" id="delete-form-{{ $post->id }}">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger"
                                                data-toggle="tooltip" title="Xóa bài viết"
                                                onclick="return confirm('Bạn có chắc chắn muốn xóa bài viết này?')">
                                                <i class="fas fa-trash"></i>
                                            </button>
                                        </form>
                                    @else
                                        <span class="text-muted">Không có quyền</span>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="mt-4">
                {{ $posts->links() }}
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script>
        $(function() {
            $('[data-toggle="tooltip"]').tooltip();

            // Debug delete forms
            $('form[id^="delete-form-"]').on('submit', function(e) {
                console.log('Form submitted:', this.action);
                console.log('Method:', this.method);
                console.log('CSRF token:', $(this).find('input[name="_token"]').val());
            });
        });
    </script>
@endpush

<style>
    .table thead th {
        background: #f8f9fc;
        color: #343a40;
        font-weight: 600;
        border-top: none;
    }

    .table td,
    .table th {
        vertical-align: middle;
    }

    .badge-success {
        background-color: #28a745;
    }

    .badge-warning {
        background-color: #ffc107;
    }

    .badge-secondary {
        background-color: #6c757d;
    }

    .btn-outline-primary {
        border-color: #007bff;
        color: #007bff;
    }

    .btn-outline-primary:hover {
        background: #007bff;
        color: #fff;
    }

    .btn-outline-danger {
        border-color: #dc3545;
        color: #dc3545;
    }

    .btn-outline-danger:hover {
        background: #dc3545;
        color: #fff;
    }

    .btn-outline-info {
        border-color: #17a2b8;
        color: #17a2b8;
    }

    .btn-outline-info:hover {
        background: #17a2b8;
        color: #fff;
    }

    @media (max-width: 767.98px) {
        .table-responsive {
            font-size: 0.95rem;
        }

        .table th,
        .table td {
            padding: 0.5rem;
        }
    }
</style>
