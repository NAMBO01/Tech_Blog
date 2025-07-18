@extends('template.template_admin')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Thêm thẻ mới</h1>
        <form action="{{ route('admin.tags.store') }}" method="POST">
            @csrf
            <div class="form-group">
                <label for="name">Tên thẻ</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Thêm mới</button>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
