@extends('template.template_admin')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Quản lý Thẻ</h1>
        <a href="{{ route('admin.tags.create') }}" class="btn btn-primary mb-3">Thêm thẻ mới</a>
        <div class="card shadow mb-4">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Tên thẻ</th>
                                <th>Hành động</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tags as $tag)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $tag->name }}</td>
                                    <td>
                                        <a href="{{ route('admin.tags.edit', $tag->id) }}"
                                            class="btn btn-sm btn-warning">Sửa</a>
                                        <form action="{{ route('admin.tags.destroy', $tag->id) }}" method="POST"
                                            style="display:inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-danger"
                                                onclick="return confirm('Bạn có chắc muốn xóa?')">Xóa</button>
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
@endsection
