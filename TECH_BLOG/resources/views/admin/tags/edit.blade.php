@extends('template.template_admin')
@section('content')
    <div class="container-fluid">
        <h1 class="h3 mb-4 text-gray-800">Sửa thẻ</h1>
        <form action="{{ route('admin.tags.update', $tag->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group">
                <label for="name">Tên thẻ</label>
                <input type="text" name="name" id="name" class="form-control" value="{{ $tag->name }}" required>
            </div>
            <button type="submit" class="btn btn-primary">Cập nhật</button>
            <a href="{{ route('admin.tags.index') }}" class="btn btn-secondary">Quay lại</a>
        </form>
    </div>
@endsection
