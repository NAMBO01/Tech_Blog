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
                                        <h4 class="m-0 font-weight-bold text-primary"><i
                                                class="fas fa-plus-circle mr-2"></i>Thêm bài viết mới</h4>
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
                                        @php $isAdmin = auth()->user() && auth()->user()->isAdmin(); @endphp
                                        <form action="{{ route('admin.posts.store') }}" method="POST"
                                            enctype="multipart/form-data" id="create-post-form">
                                            @csrf
                                            <div class="form-row">
                                                <div class="form-group col-md-8">
                                                    <label for="title" class="font-weight-bold"><i
                                                            class="fas fa-heading mr-1"></i>Tiêu đề</label>
                                                    <input type="text"
                                                        class="form-control form-control-lg @error('title') is-invalid @enderror"
                                                        id="title" name="title" value="{{ old('title') }}" required
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
                                                        id="slug" name="slug" value="{{ old('slug') }}" required
                                                        placeholder="slug-bai-viet">
                                                    @error('slug')
                                                        <div class="invalid-feedback">{{ $message }}</div>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="form-group">
                                                <label for="summary" class="font-weight-bold"><i
                                                        class="fas fa-align-left mr-1"></i>Tóm tắt</label>
                                                <textarea class="form-control @error('summary') is-invalid @enderror" id="summary" name="summary" rows="3"
                                                    placeholder="Tóm tắt nội dung bài viết...">{{ old('summary') }}</textarea>
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
                                                        tự động điền nội
                                                        dung</small>
                                                </div>
                                                <textarea class="form-control @error('content') is-invalid @enderror" id="content" name="content" rows="10"
                                                    placeholder="Nhập nội dung chi tiết...">{{ old('content') }}</textarea>
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
                                                                {{ old('category_id') == $category->id ? 'selected' : '' }}>
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
                                                                {{ old('field_id') == $field->id ? 'selected' : '' }}>
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
                                                                {{ in_array($tag->id, old('tags', [])) ? 'selected' : '' }}>
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
                                                                {{ old('status') == 'draft' ? 'selected' : '' }}>Bản nháp
                                                            </option>
                                                            <option value="review"
                                                                {{ old('status') == 'review' ? 'selected' : '' }}>Chờ duyệt
                                                            </option>
                                                            <option value="published"
                                                                {{ old('status') == 'published' ? 'selected' : '' }}>Đã
                                                                xuất
                                                                bản</option>
                                                        </select>
                                                    @else
                                                        <input type="hidden" name="status" value="draft">
                                                        <input type="text" class="form-control" value="Bản nháp"
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
                                                    <img id="cover_preview" src="#" alt="Preview"
                                                        style="display:none; max-width: 200px; border-radius: 8px; border: 1px solid #e3e6f0;" />
                                                </div>
                                            </div>
                                            <div class="form-group text-right mt-4 d-flex justify-content-end gap-2">
                                                <button type="submit" class="btn btn-lg btn-secondary mr-2"
                                                    name="save_as_draft" value="1" id="draft-btn">
                                                    <span class="btn-text"><i class="fas fa-save mr-2"></i>Lưu bản
                                                        nháp</span>
                                                </button>
                                                <button type="submit" class="btn btn-lg btn-primary px-5"
                                                    id="submit-btn">
                                                    <span class="btn-text"><i class="fas fa-paper-plane mr-2"></i>Tạo bài
                                                        viết</span>
                                                    <span class="btn-loading d-none"><i
                                                            class="fas fa-spinner fa-spin mr-2"></i>Đang lưu...</span>
                                                </button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                <div class="mb-5"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Content Wrapper -->
            </div>
            <!-- End of Page Wrapper -->
    </body>
@endsection

@push('scripts')
    <script src="https://cdnjs.cloudflare.com/ajax/libs/mammoth/1.7.0/mammoth.browser.min.js"></script>
    <script>
        function slugify(str) {
            str = str.toLowerCase();
            str = str.normalize('NFD').replace(/[\u0300-\u036f]/g, ''); // Bỏ dấu tiếng Việt
            str = str.replace(/đ/g, 'd');
            str = str.replace(/[^a-z0-9\s-]/g, ''); // Loại ký tự đặc biệt
            str = str.replace(/\s+/g, '-'); // Thay khoảng trắng bằng -
            str = str.replace(/-+/g, '-'); // Gộp nhiều dấu -
            str = str.replace(/^-+|-+$/g, ''); // Bỏ - ở đầu/cuối
            return str;
        }
        $(function() {
            $('.select2').select2({
                placeholder: 'Chọn tag',
                width: '100%'
            });
            $('.custom-file-input').on('change', function() {
                var fileName = $(this).val().split('\\').pop();
                $(this).next('.custom-file-label').addClass('selected').html(fileName);
            });
            // Tự động sinh slug khi nhập tiêu đề
            let autoSlug = '';
            $('#title').on('input', function() {
                autoSlug = slugify($(this).val());
                let $slug = $('#slug');
                if ($slug.val() === '' || $slug.val() === autoSlug) {
                    $slug.val(autoSlug);
                }
            });
            // Nếu user sửa slug thủ công, không tự động cập nhật nữa
            $('#slug').on('input', function() {
                if ($(this).val() !== autoSlug) {
                    $(this).data('manual', true);
                }
            });
            // Upload file nội dung bài viết
            $('#content_file').on('change', function(e) {
                var file = e.target.files[0];
                if (!file) return;
                var ext = file.name.split('.').pop().toLowerCase();
                if (file.type === 'text/plain' || ext === 'md') {
                    var reader = new FileReader();
                    reader.onload = function(evt) {
                        $('#content').val(evt.target.result);
                    };
                    reader.readAsText(file);
                } else if (ext === 'docx') {
                    mammoth.convertToHtml({
                        arrayBuffer: file
                    }).then(function(resultObject) {
                        var html = resultObject.value;
                        var tempDiv = document.createElement('div');
                        tempDiv.innerHTML = html;
                        var text = tempDiv.innerText || tempDiv.textContent;
                        $('#content').val(text);
                    }).catch(function(err) {
                        alert('Không đọc được file .docx: ' + err.message);
                    });
                } else if (ext === 'html' || file.type === 'text/html') {
                    var reader = new FileReader();
                    reader.onload = function(evt) {
                        var tempDiv = document.createElement('div');
                        tempDiv.innerHTML = evt.target.result;
                        var text = tempDiv.innerText || tempDiv.textContent;
                        $('#content').val(text);
                    };
                    reader.readAsText(file);
                } else if (ext === 'rtf') {
                    var reader = new FileReader();
                    reader.onload = function(evt) {
                        var rtf = evt.target.result;
                        var text = rtf.replace(/\\par[d]?/g, '\n').replace(/\{.*?\}/g, '').replace(
                            /\\[a-z]+[0-9]?/g, '');
                        $('#content').val(text);
                    };
                    reader.readAsText(file);
                } else {
                    alert('Chỉ hỗ trợ file .txt, .md, .docx, .html, .rtf');
                    $(this).val('');
                }
            });
        });
        // Preview cover image
        function previewCover(event) {
            var reader = new FileReader();
            reader.onload = function() {
                var output = document.getElementById('cover_preview');
                output.src = reader.result;
                output.style.display = 'block';
            };
            if (event.target.files[0]) {
                reader.readAsDataURL(event.target.files[0]);
            }
        }
        // Loading state
        document.getElementById('create-post-form').addEventListener('submit', function() {
            var btn = document.getElementById('submit-btn');
            btn.disabled = true;
            btn.querySelector('.btn-text').classList.add('d-none');
            btn.querySelector('.btn-loading').classList.remove('d-none');
        });
    </script>
@endpush

<style>
    .card {
        border-radius: 1rem;
    }

    .form-control,
    .custom-file-input,
    .custom-file-label,
    .select2-selection {
        border-radius: 0.5rem;
        min-height: 44px;
        font-size: 1rem;
    }

    .form-control:focus,
    .custom-file-input:focus,
    .select2-selection:focus {
        box-shadow: 0 0 0 0.2rem #007bff33;
    }

    .select2-container--default .select2-selection--multiple {
        min-height: 44px;
        border-radius: 0.5rem;
        border: 1px solid #ced4da;
        padding: 0.375rem 0.75rem;
    }

    .select2-container--default .select2-selection--multiple .select2-selection__choice {
        background: #007bff;
        color: #fff;
        border: none;
        border-radius: 0.5rem;
        padding: 0.25rem 0.75rem;
        margin-top: 0.25rem;
    }

    .btn-primary {
        background: #007bff;
        border: none;
        border-radius: 0.5rem;
        font-weight: 600;
    }

    .btn-primary:disabled {
        background: #007bff;
        opacity: 0.7;
    }

    .btn-loading {
        display: none;
    }

    .btn:disabled .btn-text {
        display: none;
    }

    .btn:disabled .btn-loading {
        display: inline-block;
    }

    @media (max-width: 767.98px) {
        .card {
            border-radius: 0.7rem;
        }

        .form-control,
        .custom-file-input,
        .custom-file-label,
        .select2-selection {
            font-size: 0.97rem;
        }
    }
</style>
