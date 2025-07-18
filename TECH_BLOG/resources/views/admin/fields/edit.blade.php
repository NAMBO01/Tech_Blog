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
                    <div class="container-fluid d-flex justify-content-center align-items-center" style="min-height: 80vh;">
                        <div class="card shadow-lg" style="width: 480px; max-width: 100%; border-radius: 1.5rem;">
                            <div class="card-header bg-warning text-white text-center"
                                style="border-radius: 1.5rem 1.5rem 0 0;">
                                <h4 class="mb-0"><i class="fas fa-edit mr-2"></i>Sửa lĩnh vực</h4>
                            </div>
                            <div class="card-body p-4">
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul class="mb-0">
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                                <form action="{{ route('admin.fields.update', $field->id) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <div class="form-group">
                                        <label for="name"><i class="fas fa-tag"></i> Tên lĩnh vực</label>
                                        <input type="text" name="name" id="name"
                                            class="form-control @error('name') is-invalid @enderror"
                                            value="{{ old('name', $field->name) }}" required>
                                        @error('name')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="slug"><i class="fas fa-link"></i> Slug</label>
                                        <input type="text" name="slug" id="slug"
                                            class="form-control @error('slug') is-invalid @enderror"
                                            value="{{ old('slug', $field->slug) }}" required>
                                        @error('slug')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="form-group">
                                        <label for="description"><i class="fas fa-align-left"></i> Mô tả (tuỳ chọn)</label>
                                        <textarea name="description" id="description" class="form-control @error('description') is-invalid @enderror"
                                            rows="3">{{ old('description', $field->description) }}</textarea>
                                        @error('description')
                                            <div class="invalid-feedback">{{ $message }}</div>
                                        @enderror
                                    </div>
                                    <div class="d-flex justify-content-between align-items-center mt-4">
                                        <button type="submit" class="btn btn-warning btn-lg px-4 shadow-sm text-white"
                                            style="border-radius: 0.75rem;">
                                            <i class="fas fa-save mr-1"></i> Cập nhật
                                        </button>
                                        <a href="{{ route('admin.fields.index') }}"
                                            class="btn btn-outline-secondary btn-lg px-4" style="border-radius: 0.75rem;">
                                            <i class="fas fa-arrow-left mr-1"></i> Quay lại
                                        </a>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- End of Main Content -->

                <!-- Footer -->
                @include('widgets.admin.footer')
                <!-- End of Footer -->

            </div>
            <!-- End of Content Wrapper -->

        </div>
        <!-- End of Page Wrapper -->

        <!-- Scroll to Top Button-->
        <a class="scroll-to-top rounded" href="#page-top">
            <i class="fas fa-angle-up"></i>
        </a>

        <!-- Logout Modal-->

    </body>

    </section>
