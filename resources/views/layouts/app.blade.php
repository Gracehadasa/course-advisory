<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="shortcut icon" href="{{asset('dist/img/AdminLTELogo.png')}}" type="image/x-icon">
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="fonts/icomoon/style.css">

            <link rel="stylesheet" href="{{asset('css/bootstrap.min.css')}}">
            <link rel="stylesheet" href="{{asset('css/jquery-ui.css')}}">
            <link rel="stylesheet" href="{{asset('css/owl.carousel.min.css')}}">
            <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">
            <link rel="stylesheet" href="{{asset('css/owl.theme.default.min.css')}}">

            <link rel="stylesheet" href="{{asset('css/jquery.fancybox.min.css')}}">

            <link rel="stylesheet" href="{{asset('css/bootstrap-datepicker.css')}}">

            <link rel="stylesheet" href="{{asset('fonts/flaticon/font/flaticon.css')}}">

            <link rel="stylesheet" href="{{asset('css/aos.css')}}">
            <link href="{{asset('css/jquery.mb.YTPlayer.min.css')}}" media="all" rel="stylesheet" type="text/css">

            <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>
<body>
    <div id="app">
      @include('generals.nav')

        <main class="py-4">

<!-- error -->
<div class="row justify-content-center mt-5">
 @if(session()->has('success'))
    <div class="alert alert-success col-md-8">
        {{ session()->get('success') }}
    </div>
@endif
@if(session()->has('error'))
    <div class="alert alert-danger col-md-8">
        {{ session()->get('error') }}
    </div>
@endif
 </div>
<!-- enderror -->
            @yield('content')
        </main>
        @include('generals.footer')

    </div>
</body>
<!-- loader -->
<div id="loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#51be78"/></svg></div>

<script src="{{asset('js/jquery-3.3.1.min.js')}}"></script>
<script src="{{asset('js/jquery-migrate-3.0.1.min.js')}}"></script>
<script src="{{asset('js/jquery-ui.js')}}"></script>
<!-- <script src="{{asset('js/popper.min.js')}}"></script>
<script src="{{asset('js/bootstrap.min.js')}}"></script> -->
<script src="{{asset('js/owl.carousel.min.js')}}"></script>
<script src="{{asset('js/jquery.stellar.min.js')}}"></script>
<script src="{{asset('js/jquery.countdown.min.js')}}"></script>
<script src="{{asset('js/bootstrap-datepicker.min.js')}}"></script>
<script src="{{asset('js/jquery.easing.1.3.js')}}"></script>
<script src="{{asset('js/aos.js')}}"></script>
<script src="{{asset('js/jquery.fancybox.min.js')}}"></script>
<script src="{{asset('js/jquery.sticky.js')}}"></script>
<script src="{{asset('js/jquery.mb.YTPlayer.min.js')}}"></script>




<script src="{{asset('js/main.js')}}"></script>
</html>
