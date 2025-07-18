@extends('template.template_user')
@section('main-content')
    @include('user.home')
@endsection

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const btn = document.getElementById('userMenuBtn');
        const menu = document.querySelector('.user-menu');
        if (btn && menu) {
            btn.addEventListener('click', function(e) {
                e.stopPropagation();
                menu.classList.toggle('open');
            });
            document.addEventListener('click', function() {
                menu.classList.remove('open');
            });
        }
    });
</script>
</body>

</html>
