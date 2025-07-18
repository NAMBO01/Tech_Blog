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
                        @if (session('success'))
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                        @endif
                        <h1 class="h3 mb-4 text-gray-800 text-center font-weight-bold"><i
                                class="fas fa-list-alt mr-2"></i>Quản lý Lĩnh vực</h1>
                        @if (auth()->user() && auth()->user()->isAdmin())
                            <a href="{{ route('admin.fields.create') }}" class="btn btn-primary mb-3"><i
                                    class="fas fa-plus-circle mr-1"></i> Thêm lĩnh vực mới</a>
                        @endif
                        <div class="card shadow-lg mb-4" style="border-radius: 1.5rem;">
                            <div class="card-header bg-gradient-primary text-white text-center"
                                style="border-radius: 1.5rem 1.5rem 0 0; font-size: 1.2rem; font-weight: 600;">
                                <i class="fas fa-table mr-2"></i>Danh sách lĩnh vực
                            </div>
                            <div class="card-body p-4">
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover align-middle" width="100%"
                                        cellspacing="0" style="background: #fff;">
                                        <thead class="thead-light">
                                            <tr class="text-center">
                                                <th style="width: 60px;">STT</th>
                                                <th style="min-width: 180px;">Tên lĩnh vực</th>
                                                <th style="min-width: 200px;">Mô tả</th>
                                                @if (auth()->user() && auth()->user()->isAdmin())
                                                    <th style="width: 140px;">Hành động</th>
                                                @endif
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($fields as $field)
                                                <tr>
                                                    <td class="text-center">{{ $loop->iteration }}</td>
                                                    <td class="font-weight-bold">{{ $field->name }}</td>
                                                    <td>{{ Str::limit($field->description, 60) }}</td>
                                                    @if (auth()->user() && auth()->user()->isAdmin())
                                                        <td class="text-center">
                                                            <a href="{{ route('admin.fields.edit', $field->id) }}"
                                                                class="btn btn-sm btn-warning mr-1" title="Sửa"><i
                                                                    class="fas fa-edit"></i></a>
                                                            <form action="{{ route('admin.fields.destroy', $field->id) }}"
                                                                method="POST" style="display:inline-block">
                                                                @csrf
                                                                @method('DELETE')
                                                                <button type="submit" class="btn btn-sm btn-danger"
                                                                    title="Xóa"
                                                                    onclick="return confirm('Bạn có chắc muốn xóa?')"><i
                                                                        class="fas fa-trash-alt"></i></button>
                                                            </form>
                                                        </td>
                                                    @endif
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                @endsection
