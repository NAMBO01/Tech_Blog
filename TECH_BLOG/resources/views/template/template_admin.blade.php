@include('widgets.admin.head')

<body>
    <!-- container section start -->
    <section id="container" class="">
        @yield('main-content')
    </section>
    <!-- container section start -->

    @include('widgets.admin.footer')

    <!-- Bootstrap core JavaScript-->
    <script src="{{ asset('admin_page/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('admin_page/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <!-- Core plugin JavaScript-->
    <script src="{{ asset('admin_page/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <!-- Custom scripts for all pages-->
    <script src="{{ asset('admin_page/js/sb-admin-2.min.js') }}"></script>

    <!-- Page level plugins -->
    <script src="{{ asset('admin_page/vendor/datatables/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('admin_page/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Page level custom scripts -->
    <script src="{{ asset('js/demo/datatables-demo.js') }}"></script>

    <!-- Sidebar Toggle Script -->
    <script>
        // Toggle the side navigation
        $("#sidebarToggle").on('click', function(e) {
            $("body").toggleClass("sidebar-toggled");
            $(".sidebar").toggleClass("toggled");
            if ($(".sidebar").hasClass("toggled")) {
                $('.sidebar .collapse').collapse('hide');
            };
        });

        // Prevent the content wrapper from scrolling when the fixed side navigation hovered over
        $('body.fixed-nav .sidebar').on('mousewheel DOMMouseScroll wheel', function(e) {
            if ($(window).width() > 768) {
                var e0 = e.originalEvent,
                    delta = e0.wheelDelta || -e0.detail;
                this.scrollTop += (delta < 0 ? 1 : -1) * 30;
                e.preventDefault();
            }
        });

        // Close any open menu accordions when window is resized below 768px
        $(window).resize(function() {
            if ($(window).width() < 768) {
                $('.sidebar .collapse').collapse('hide');
            };
        });
    </script>

    @yield('scripts')
</body>

</html>
