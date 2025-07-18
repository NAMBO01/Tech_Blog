@extends('template.template_admin')

@section('title', 'Thêm danh mục mới')

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
                        <!-- Page Heading -->
                        <div class="d-sm-flex align-items-center justify-content-between mb-4">
                            <h1 class="h3 mb-0 text-gray-800">Thêm danh mục mới</h1>
                            <a href="{{ route('admin.admin_cate') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left"></i> Quay lại
                            </a>
                        </div>

                        <div class="card shadow mb-4">
                            <div class="card-body">
                                <form action="{{ route('admin.categories.store') }}" method="POST">
                                    @csrf

                                    <div class="form-group">
                                        <label for="name">Tên danh mục <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control @error('name') is-invalid @enderror"
                                            id="name" name="name" value="{{ old('name') }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="slug">Slug</label>
                                        <input type="text" class="form-control @error('slug') is-invalid @enderror"
                                            id="slug" name="slug" value="{{ old('slug') }}" required>
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="description">Mô tả</label>
                                        <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description"
                                            rows="3">{{ old('description') }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="parent_id">Danh mục cha</label>
                                        <select class="form-control @error('parent_id') is-invalid @enderror" id="parent_id"
                                            name="parent_id">
                                            <option value="">Không có</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}"
                                                    {{ old('parent_id') == $category->id ? 'selected' : '' }}>
                                                    {{ $category->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        @error('parent_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="field_id">Lĩnh vực</label>
                                        <div class="input-group">
                                            <select class="form-control @error('field_id') is-invalid @enderror"
                                                id="field_id" name="field_id">
                                                <option value="">Chọn lĩnh vực</option>
                                                @foreach ($fields as $field)
                                                    <option value="{{ $field->id }}"
                                                        {{ old('field_id') == $field->id ? 'selected' : '' }}>
                                                        {{ $field->name }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            <div class="input-group-append">
                                                <button type="button" class="btn btn-primary" data-toggle="modal"
                                                    data-target="#addFieldModal">
                                                    <i class="fas fa-plus"></i> Thêm lĩnh vực mới
                                                </button>
                                            </div>
                                        </div>
                                        @error('field_id')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>

                                    <button type="submit" class="btn btn-primary">
                                        <i class="fas fa-save"></i> Lưu
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                    @include('widgets.admin.footer')
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->

            <!-- Modal thêm lĩnh vực mới -->
            <div class="modal fade" id="addFieldModal" tabindex="-1" role="dialog" aria-labelledby="addFieldModalLabel"
                aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="addFieldModalLabel">Thêm lĩnh vực mới</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <form id="addFieldForm">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="field_name">Tên lĩnh vực</label>
                                    <input type="text" class="form-control" id="field_name" name="name" required>
                                </div>
                                <div class="form-group">
                                    <label for="field_description">Mô tả</label>
                                    <textarea class="form-control" id="field_description" name="description" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Đóng</button>
                                <button type="submit" class="btn btn-primary">Thêm lĩnh vực</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
    </body>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            // Tự động tạo slug từ tên danh mục
            $('#name').on('keyup', function() {
                var name = $(this).val();
                var slug = name.toLowerCase()
                    .replace(/đ/g, 'd')
                    .replace(/[^a-z0-9-]/g, '-')
                    .replace(/-+/g, '-')
                    .replace(/^-|-$/g, '');
                $('#slug').val(slug);
            });

            // Xử lý form thêm lĩnh vực mới
            $('#addFieldForm').on('submit', function(e) {
                e.preventDefault();

                $.ajax({
                    url: '{{ route('admin.fields.store') }}',
                    method: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        name: $('#field_name').val(),
                        description: $('#field_description').val()
                    },
                    success: function(response) {
                        // Thêm lĩnh vực mới vào select
                        $('#field_id').append(new Option(response.name, response.id, true,
                            true));

                        // Đóng modal và reset form
                        $('#addFieldModal').modal('hide');
                        $('#addFieldForm')[0].reset();

                        // Hiển thị thông báo thành công
                        toastr.success('Thêm lĩnh vực mới thành công');
                    },
                    error: function(xhr) {
                        // Hiển thị lỗi
                        var errors = xhr.responseJSON.errors;
                        if (errors) {
                            Object.keys(errors).forEach(function(key) {
                                toastr.error(errors[key][0]);
                            });
                        } else {
                            toastr.error('Có lỗi xảy ra khi thêm lĩnh vực');
                        }
                    }
                });
            });
        });
    </script>
@endpush
