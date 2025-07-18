@extends('template.template_admin')
@section('main-content')
    <div class="container">
        <h2>Chỉnh sửa chờ duyệt</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Bài viết</th>
                    <th>Nội dung chỉnh sửa</th>
                    <th>Người chỉnh sửa</th>
                    <th>Thời gian</th>
                    <th>Thao tác</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($revisions as $rev)
                    <tr>
                        <td>{{ $rev->post->title ?? 'N/A' }}</td>
                        <td>{{ Str::limit($rev->content, 100) }}</td>
                        <td>{{ $rev->editor->name ?? 'N/A' }}</td>
                        <td>{{ $rev->edited_at->setTimezone('Asia/Ho_Chi_Minh')->format('d/m/Y H:i') }}</td>
                        <td>
                            <form action="{{ route('admin.revisions.approve', $rev->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                <button class="btn btn-success btn-sm"
                                    onclick="return confirm('Duyệt chỉnh sửa này?')">Duyệt</button>
                            </form>
                            <form action="{{ route('admin.revisions.reject', $rev->id) }}" method="POST"
                                style="display:inline">
                                @csrf
                                <button class="btn btn-danger btn-sm" onclick="return confirm('Từ chối chỉnh sửa này?')">Từ
                                    chối</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
