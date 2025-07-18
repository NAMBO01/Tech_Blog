@include('widgets.user.head')

<body>
    @include('widgets.user.header')

    <main id="main-content">
        @if (session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert"
                style="margin: 20px; border-radius: 10px;">
                <i class="fas fa-check-circle mr-2"></i> {{ session('success') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @if (session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert"
                style="margin: 20px; border-radius: 10px;">
                <i class="fas fa-exclamation-circle mr-2"></i> {{ session('error') }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        @endif

        @yield('main-content')
    </main>

    @include('widgets.user.footer')
</body>

</html>
