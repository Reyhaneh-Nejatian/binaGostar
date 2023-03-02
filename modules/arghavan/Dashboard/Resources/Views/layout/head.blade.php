<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0;">
    <meta name="_token" content="{{ csrf_token() }}">
    <title>Panel</title>
    <link rel="stylesheet" href="{{ asset('Panel/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('Panel/css/responsive_991.css') }}" media="(max-width:991px)">
    <link rel="stylesheet" href="{{ asset('Panel/css/responsive_768.css') }}" media="(max-width:768px)">
    <link rel="stylesheet" href="{{ asset('Panel/css/font.css') }}">
    <link type="text/css" rel="stylesheet" href="{{ asset('css/jalalidatepicker.min.css') }}" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" >

    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/2.0.1/css/toastr.css" rel="stylesheet"/>


    @yield('css')
</head>
