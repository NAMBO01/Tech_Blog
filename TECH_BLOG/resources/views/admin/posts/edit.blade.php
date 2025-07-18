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
                        <div class="row justify-content-center">
                            <div class="col-lg-9 col-xl-8">
                                <div class="card shadow-lg border-0 mt-4">
                                    <div class="card-header bg-white border-0 py-3 d-flex align-items-center">
                                        <h4 class="m-0 font-weight-bold text-primary"><i class="fas fa-edit mr-2"></i>Chỉnh
                                            sửa bài viết</h4>
                                    </div>
                                    <div class="card-body p-4">
                                        @if ($errors->any())
                                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                                <strong><i class="fas fa-exclamation-triangle mr-2"></i>Lỗi!</strong>
                                                <ul class="mb-0 mt-1">
                                                    @foreach ($errors->all() as $error)
                                                        <li>{{ $error }}</li>
                                                    @endforeach
                                                </ul>
                                                <button type="button" class="close" data-dismiss="alert"
                                                    aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                        @endif
                                        @php $isAdmin = auth()->user() && auth()->user()->role === 'admin'; @endphp
                                        <form action="{{ route('admin.posts.update', $post->id) }}" method="POST"
                                            enctype="multipart/form-data" id="edit-post-form">
                                            @csrf
                                            @method('PUT')
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="title" class="font-weight-bold"><i
                                                            class="fas fa-heading mr-1"></i>Tiêu đề</label>
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('title') is-invalid @enderror"
                                                        id="title" name="title"
                                                        value="{{ old('title', $post->title) }}" required
                                                        placeholder="Nhập tiêu đề bài viết">
                                                    @error('title')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="slug" class="font-weight-bold"><i
                                                            class="fas fa-link mr-1"></i>Slug</label>
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('slug') is-invalid @enderror"
                                                        id="slug" name="slug" value="{{ old('slug', $post->slug) }}"
                                                        required placeholder="slug-bai-viet">
                                                    @error('slug')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="summary" class="font-weight-bold"><i
                                                        class="fas fa-align-left mr-1"></i>Tóm tắt</label>
                                                <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3"
                                                    placeholder="Tóm tắt nội dung bài viết...">{{ old('summary', $post->summary) }}</textarea>
                                                @error('summary')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-group">
                                                <label for="content" class="font-weight-bold"><i
                                                        class="fas fa-file-alt mr-1"></i>Nội dung</label>
                                                <div class="d-flex align-items-center mb-2">
                                                    <input type="file" id="content_file"
                                                        accept=".txt,.md,.docx,.html,.rtf" class="form-control-file mr-3"
                                                        style="max-width: 250px;">
                                                    <small class="text-muted">Chọn file .txt, .md, .docx, .html hoặc .rtf để
                                                        tự động điền nội dung</small>
                                                </div>
                                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10"
                                                    placeholder="Nhập nội dung chi tiết...">{{ old('content', $post->content) }}</textarea>
                                                @error('content')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="category_id" class="font-weight-bold"><i
                                                            class="fas fa-folder-open mr-1"></i>Danh mục</label>
                                                    <select class="form-control @error('category_id') is-invalid @enderror"
                                                        id="category_id" name="category_id" required>
                                                        <option value="">Chọn danh mục</option>
                                                        @foreach ($categories as $category)
                                                            <option value="{{ $category->id }}"
                                                                {{ old('category_id', $post->category_id) == $category->id ? 'selected' : '' }}>
                                                                {{ $category->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('category_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="field_id" class="font-weight-bold"><i
                                                            class="fas fa-th-large mr-1"></i>Lĩnh vực</label>
                                                    <select class="form-control @error('field_id') is-invalid @enderror"
                                                        id="field_id" name="field_id" required>
                                                        <option value="">Chọn lĩnh vực</option>
                                                        @foreach ($fields as $field)
                                                            <option value="{{ $field->id }}"
                                                                {{ old('field_id', $post->field_id) == $field->id ? 'selected' : '' }}>
                                                                {{ $field->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('field_id')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="tags" class="font-weight-bold"><i
                                                            class="fas fa-tags mr-1"></i>Tags</label>
                                                    <select
                                                        class="form-control select2 @error('tags') is-invalid @enderror"
                                                        id="tags" name="tags[]" multiple required>
                                                        @foreach ($tags as $tag)
                                                            <option value="{{ $tag->id }}"
                                                                {{ in_array($tag->id, old('tags', $post->tags->pluck('id')->toArray())) ? 'selected' : '' }}>
                                                                {{ $tag->name }}</option>
                                                        @endforeach
                                                    </select>
                                                    @error('tags')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="status" class="font-weight-bold"><i
                                                            class="fas fa-toggle-on mr-1"></i>Trạng thái</label>
                                                    @if ($isAdmin)
                                                        <select class="form-control @error('status') is-invalid @enderror"
                                                            id="status" name="status" required>
                                                            <option value="draft"
                                                                {{ old('status', $post->status) == 'draft' ? 'selected' : '' }}>
                                                                Bản nháp
                                                            </option>
                                                            <option value="review"
                                                                {{ old('status', $post->status) == 'review' ? 'selected' : '' }}>
                                                                Chờ duyệt
                                                            </option>
                                                            <option value="published"
                                                                {{ old('status', $post->status) == 'published' ? 'selected' : '' }}>
                                                                Đã
                                                                xuất bản</option>
                                                        </select>
                                                    @else
                                                        <input type="hidden" name="status"
                                                            value="{{ $post->status }}">
                                                        <input type="text" class="form-control"
                                                            value="{{ $post->status == 'draft' ? 'Bản nháp' : ($post->status == 'review' ? 'Chờ duyệt' : 'Đã xuất bản') }}"
                                                            disabled>
                                                    @endif
                                                    @error('status')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="cover_image" class="font-weight-bold"><i
                                                        class="fas fa-image mr-1"></i>Ảnh bìa</label>
                                                <div class="custom-file">
                                                    <input type="file"
                                                        class="custom-file-input @error('cover_image') is-invalid @enderror"
                                                        id="cover_image" name="cover_image" accept="image/*"
                                                        onchange="previewCover(event)">
                                                    <label class="custom-file-label" for="cover_image">Chọn ảnh...</label>
                                                    @error('cover_image')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                                <div class="mt-3">
                                                    @if ($post->cover_image_url)
                                                        <img id="cover_preview" src="{{ asset($post->cover_image_url) }}"
                                                            alt="Current Cover"
                                                            style="max-width: 200px; border-radius: 8px; border: 1px solid #e3e6f0;" />
                                                    @else
                                                        <img id="cover_preview" src="#" alt="Preview"
                                                            style="display:none; max-width: 200px; border-radius: 8px; border: 1px solid #e3e6f0;" />
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="form-group text-right mt-4 d-flex justify-content-end gap-2">
                                                <a href="{{ route('admin.post_admin') }}"
                                                    class="btn btn-lg btn-secondary mr-2">
                                                    <i class="fas fa-arrow-left mr-2"></i>Quay lại
                                                </a>
                                                <button type="submit" class="btn btn-primary px-4 py-2">
                                                    Cập nhật
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
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
        .select2-container--default .select2-selection--multiple {
            border: 1px solid #d1d3e2;
            border-radius: 0.35rem;
        }

        .select2-container--default .select2-selection--multiple:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .custom-file-label::after {
            content: "Duyệt";
        }

        .btn-loading .btn-text {
            display: none;
        }

        .btn-loading .btn-loading {
            display: inline-block !important;
        }

        .form-control:focus {
            border-color: #bac8f3;
            box-shadow: 0 0 0 0.2rem rgba(78, 115, 223, 0.25);
        }

        .card {
            border-radius: 0.75rem;
        }

        .card-header {
            border-bottom: 1px solid #e3e6f0;
        }

        .form-control-lg {
            font-size: 1.1rem;
        }

        .btn-lg {
            padding: 0.75rem 1.5rem;
            font-size: 1.1rem;
        }
    </style>

    <script>
        $(document).ready(function() {
            // Initialize Select2
            $('.select2').select2({
                theme: 'bootstrap4',
                placeholder: 'Chọn tags...',
                allowClear: true
            });

            // Auto-generate slug from title
            $('#title').on('input', function() {
                let title = $(this).val();
                let slug = title.toLowerCase()
                    .replace(/[^a-z0-9\s-]/g, '')
                    .replace(/\s+/g, '-')
                    .replace(/-+/g, '-')
                    .trim('-');
                $('#slug').val(slug);
            });

            // File content upload
            $('#content_file').on('change', function() {
                const file = this.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#content').val(e.target.result);
                    };
                    reader.readAsText(file);
                }
            });

            // Cover image preview
            window.previewCover = function(event) {
                const file = event.target.files[0];
                if (file) {
                    const reader = new FileReader();
                    reader.onload = function(e) {
                        $('#cover_preview').attr('src', e.target.result).show();
                    };
                    reader.readAsDataURL(file);
                    $('.custom-file-label').text(file.name);
                }
            };

            // Form submission
            $('#edit-post-form').on('submit', function() {
                $('#submit-btn').addClass('btn-loading');
                $('.btn-text').addClass('d-none');
                $('.btn-loading').removeClass('d-none');
            });
        });
    </script>
@endsection
