<!DOCTYPE html>
<html lang="fa">

<head>
    <meta charset="utf-8" />
    <link rel="apple-touch-icon" sizes="76x76" href="{{ asset('img/apple-icon.png') }}">
    <link rel="icon" type="image/png" href="{{ asset('img/favicon.png') }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no'
          name='viewport' />
    <title>Digikala</title>
    <!--     Fonts and icons     -->
    <link rel="stylesheet" href="{{ asset('fonts/font-awesome/css/font-awesome.min.css') }}" />
    <!-- CSS Files -->
    <link href="{{ asset('admin/css/bootstrap.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/now-ui-kit.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/plugins/owl.carousel.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/plugins/owl.theme.default.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('admin/css/main.css') }}" rel="stylesheet" />
</head>

<body>
<div class="wrapper default">
    <div class="container">
        <div class="row">
            <div class="main-content col-12 col-md-7 col-lg-5 mx-auto">
                <div class="account-box">
                    @yield('content')
                </div>
            </div>
        </div>
    </div>
</div>
</body>
<!--   Core JS Files   -->
@yield('js')
</html>

