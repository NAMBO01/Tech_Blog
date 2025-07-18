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
                        <div class="d-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-dark font-weight-bold">
                                <i class="fas fa-history mr-2 text-primary"></i>Lịch sử chỉnh sửa bài viết
                            </h1>
                            <div>
                                <a href="{{ route('admin.posts.edit', $post->id) }}" class="btn btn-primary mr-2">
                                    <i class="fas fa-edit mr-1"></i>Chỉnh sửa bài viết
                                </a>
                                <a href="{{ route('admin.post_admin') }}" class="btn btn-secondary">
                                    <i class="fas fa-arrow-left mr-1"></i>Quay lại
                                </a>
                            </div>
                        </div>

                        <!-- Thông tin bài viết -->
                        <div class="card border-0 shadow mb-4">
                            <div class="card-header bg-white border-0 py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-file-alt mr-2"></i>Thông tin bài viết
                                </h6>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-8">
                                        <h5 class="font-weight-bold text-dark">{{ $post->title }}</h5>
                                        <p class="text-muted mb-2">{{ $post->summary }}</p>
                                        <div class="d-flex align-items-center text-sm text-muted">
                                            <span class="mr-3">
                                                <i class="fas fa-user mr-1"></i>{{ $post->author->name ?? 'N/A' }}
                                            </span>
                                            <span class="mr-3">
                                                <i class="fas fa-folder mr-1"></i>{{ $post->category->name ?? 'N/A' }}
                                            </span>
                                            <span>
                                                <i
                                                    class="fas fa-calendar mr-1"></i>{{ $post->created_at->format('d/m/Y H:i') }}
                                            </span>
                                        </div>
                                    </div>
                                    <div class="col-md-4 text-right">
                                        <span
                                            class="badge badge-{{ $post->status == 'published' ? 'success' : ($post->status == 'draft' ? 'warning' : 'secondary') }}">
                                            {{ $post->status == 'published' ? 'Đã xuất bản' : ($post->status == 'draft' ? 'Bản nháp' : 'Chờ duyệt') }}
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Danh sách phiên bản -->
                        <div class="card border-0 shadow">
                            <div class="card-header bg-white border-0 py-3">
                                <h6 class="m-0 font-weight-bold text-primary">
                                    <i class="fas fa-list mr-2"></i>Danh sách phiên bản ({{ $revisions->count() }})
                                </h6>
                            </div>
                            <div class="card-body p-0">
                                @if ($revisions->count() > 0)
                                    <div class="table-responsive">
                                        <table class="table table-hover mb-0">
                                            <thead class="thead-light">
                                                <tr>
                                                    <th>Phiên bản</th>
                                                    <th>Tiêu đề</th>
                                                    <th>Người chỉnh sửa</th>
                                                    <th>Thời gian</th>
                                                    <th>Thao tác</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($revisions as $revision)
                                                    <tr>
                                                        <td>
                                                            <span
                                                                class="badge badge-info">v{{ $revision->revision_number }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="font-weight-bold text-dark">Phiên bản
                                                                v{{ $revision->revision_number }}</div>
                                                            <small
                                                                class="text-muted">{{ Str::limit($revision->content, 80) }}</small>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex align-items-center">
                                                                @if ($revision->editor && $revision->editor->avatar_url)
                                                                    <img src="{{ asset($revision->editor->avatar_url) }}"
                                                                        alt="avatar" class="rounded-circle mr-2"
                                                                        style="width: 32px; height: 32px; object-fit: cover;">
                                                                @else
                                                                    <span class="d-inline-block text-secondary mr-2">
                                                                        <i class="fas fa-user-circle"></i>
                                                                    </span>
                                                                @endif
                                                                <span>{{ $revision->editor->name ?? 'N/A' }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="text-sm">
                                                                <div class="font-weight-bold">
                                                                    {{ $revision->edited_at->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y') }}
                                                                </div>
                                                                <div class="text-muted">
                                                                    {{ $revision->edited_at->setTimezone('Asia/Ho_Chi_Minh')->format('H:i') }}
                                                                </div>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group" role="group">
                                                                <button type="button"
                                                                    class="btn btn-sm btn-outline-primary"
                                                                    data-toggle="modal"
                                                                    data-target="#revisionModal{{ $revision->id }}"
                                                                    title="Xem chi tiết">
                                                                    <i class="fas fa-eye"></i>
                                                                </button>
                                                                @if ($loop->first)
                                                                    <span class="btn btn-sm btn-success disabled"
                                                                        title="Phiên bản hiện tại">
                                                                        <i class="fas fa-check"></i>
                                                                    </span>
                                                                @else
                                                                    <form
                                                                        action="{{ route('admin.posts.restore-revision', ['post' => $post->id, 'revision' => $revision->id]) }}"
                                                                        method="POST" class="d-inline">
                                                                        @csrf
                                                                        <button type="submit"
                                                                            class="btn btn-sm btn-outline-warning"
                                                                            onclick="return confirm('Bạn có chắc chắn muốn khôi phục phiên bản này?')"
                                                                            title="Khôi phục phiên bản">
                                                                            <i class="fas fa-undo"></i>
                                                                        </button>
                                                                    </form>
                                                                @endif
                                                            </div>
                                                        </td>
                                                    </tr>

                                                    <!-- Modal xem chi tiết phiên bản -->
                                                    <div class="modal fade" id="revisionModal{{ $revision->id }}"
                                                        tabindex="-1" role="dialog">
                                                        <div class="modal-dialog modal-xl" role="document">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title">
                                                                        <i class="fas fa-eye mr-2"></i>Phiên bản
                                                                        v{{ $revision->revision_number }}
                                                                    </h5>
                                                                    <button type="button" class="close"
                                                                        data-dismiss="modal">
                                                                        <span>&times;</span>
                                                                    </button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row mb-3">
                                                                        <div class="col-md-12">
                                                                            <strong>Nội dung phiên bản
                                                                                v{{ $revision->revision_number }}:</strong>
                                                                        </div>
                                                                    </div>
                                                                    <div class="mb-3">
                                                                        <strong>Nội dung:</strong>
                                                                        <div class="border rounded p-3 bg-light"
                                                                            style="max-height: 400px; overflow-y: auto;">
                                                                            {!! nl2br(e($revision->content)) !!}
                                                                        </div>
                                                                    </div>
                                                                    <div class="row">
                                                                        <div class="col-md-4">
                                                                            <strong>Người chỉnh sửa:</strong>
                                                                            <p>{{ $revision->editor->name ?? 'N/A' }}</p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <strong>Thời gian:</strong>
                                                                            <p>{{ $revision->edited_at->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i:s') }}
                                                                            </p>
                                                                        </div>
                                                                        <div class="col-md-4">
                                                                            <strong>Phiên bản:</strong>
                                                                            <p>v{{ $revision->revision_number }}</p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    @if (!$loop->first)
                                                                        <form
                                                                            action="{{ route('admin.posts.restore-revision', ['post' => $post->id, 'revision' => $revision->id]) }}"
                                                                            method="POST" class="d-inline">
                                                                            @csrf
                                                                            <button type="submit" class="btn btn-warning"
                                                                                onclick="return confirm('Bạn có chắc chắn muốn khôi phục phiên bản này?')">
                                                                                <i class="fas fa-undo mr-1"></i>Khôi phục
                                                                                phiên bản
                                                                            </button>
                                                                        </form>
                                                                    @endif
                                                                    <button type="button" class="btn btn-secondary"
                                                                        data-dismiss="modal">Đóng</button>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                @else
                                    <div class="text-center py-5">
                                        <i class="fas fa-history fa-3x text-muted mb-3"></i>
                                        <h5 class="text-muted">Chưa có lịch sử chỉnh sửa</h5>
                                        <p class="text-muted">Bài viết này chưa được chỉnh sửa lần nào.</p>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->
                @include('widgets.admin.footer')
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
    </body>

    <style>
        .table th {
            background: #f8f9fc;
            color: #343a40;
            font-weight: 600;
            border-top: none;
        }

        .table td,
        .table th {
            vertical-align: middle;
        }

        .badge-info {
            background-color: #17a2b8;
        }

        .btn-outline-primary {
            border-color: #007bff;
            color: #007bff;
        }

        .btn-outline-primary:hover {
            background: #007bff;
            color: #fff;
        }

        .btn-outline-warning {
            border-color: #ffc107;
            color: #ffc107;
        }

        .btn-outline-warning:hover {
            background: #ffc107;
            color: #212529;
        }

        .modal-xl {
            max-width: 1140px;
        }

        @media (max-width: 767.98px) {
            .table-responsive {
                font-size: 0.9rem;
            }

            .table th,
            .table td {
                padding: 0.5rem;
            }
        }
    </style>
@endsection
