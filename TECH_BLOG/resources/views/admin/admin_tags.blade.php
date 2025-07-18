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
                    @include('admin.admin_tags')
                </div>
                <!-- End of Main Content -->
                @include('widgets.admin.footer')
            </div>
            <!-- End of Content Wrapper -->
        </div>
        <!-- End of Page Wrapper -->
    </body>
@endsection
