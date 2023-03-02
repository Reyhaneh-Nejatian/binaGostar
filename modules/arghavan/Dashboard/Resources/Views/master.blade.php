<!DOCTYPE html>
<html lang="en">
@include('Dashboard::layout.head')
<body>
@include('Dashboard::layout.sidebar')
<div class="content">

    @include('Dashboard::layout.header')

    @include('Dashboard::layout.breadcrumb')

    <div class="main-content">
        @yield('content')

    </div>
</div>
{{--@include('sweetalert::alert', ['cdn' => "https://cdn.jsdelivr.net/npm/sweetalert2@9"])--}}
</body>
@include('Dashboard::layout.foot')
</html>
