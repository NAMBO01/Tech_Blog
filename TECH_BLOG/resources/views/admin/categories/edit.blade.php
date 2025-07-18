@extends('template.template_admin')

@section('title', 'Chỉnh sửa danh mục')

@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Chỉnh sửa danh mục</h1>
            <a href="{{ route('admin.admin_cate') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left"></i> Quay lại
            </a>
        </div>

        <div class="card shadow mb-4">
            <div class="card-body">
                <form action="{{ route('admin.categories.update', ['category' => $category->id]) }}" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="form-group">
                        <label for="name">Tên danh mục <span class="text-danger">*</span></label>
                        <input type="text" class="form-control @error('name') is-invalid @enderror" id="name"
                            name="name" value="{{ old('name', $category->name) }}" required>
                        @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="description">Mô tả</label>
                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                            rows="3">{{ old('description', $category->description) }}</textarea>
                        @error('description')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="parent_id">Danh mục cha</label>
                        <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id"
                            name="parent_id">
                            <option value="">Không có</option>
                            @foreach ($categories as $cat)
                                <option value="{{ $cat->id }}"
                                    {{ old('parent_id', $category->parent_id) == $cat->id ? 'selected' : '' }}>
                                    {{ $cat->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('parent_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="field_id">Lĩnh vực</label>
                        <select class="form-control @error('field_id') is-invalid @enderror" id="field_id" name="field_id">
                            <option value="">Không có</option>
                            @foreach ($fields as $field)
                                <option value="{{ $field->id }}"
                                    {{ old('field_id', $category->field_id) == $field->id ? 'selected' : '' }}>
                                    {{ $field->name }}
                                </option>
                            @endforeach
                        </select>
                        @error('field_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn btn-primary">
                        <i class="fas fa-save"></i> Cập nhật
                    </button>
                </form>
            </div>
        </div>
    </div>
@endsection
