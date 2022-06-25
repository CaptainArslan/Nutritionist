<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/images/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('/vendor/owl-carousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/vendor/owl-carousel/css/owl.theme.default.min.css')}}">

    <!-- Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c3e204ff59.js" crossorigin="anonymous"></script>

    <!-- Datatable -->
    <link href="{{asset('/vendor/datatables/css/jquery.dataTables.min.css')}}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <script src="{{asset('./js/sweetalert.min.js')}}"></script>
</head>

<body class="antialiased">
    <div id="main-wrapper">
        <x-header />
        <x-sidebar />
        <div class="content-body">
            @section('content-body')
            @show()
        </div>
        <x-footer />
    </div>




    <!-- Scripts -->
    <!-- <script src="{{asset('./vendor/global/global.min.js')}}"></script> -->
    <script src="{{asset('./js/quixnav-init.js')}}"></script>
    <script src="{{asset('./js/custom.min.js')}}"></script>
   
    <!-- Owl Carousel -->
    <script src="{{asset('./vendor/owl-carousel/js/owl.carousel.min.js')}}"></script>
    <!-- <script src="{{asset('./js/dashboard/dashboard-1.js')}}"></script> -->
    <!-- Datatable -->
    <script src="{{asset('./vendor/datatables/js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('./js/plugins-init/datatables.init.js')}}"></script>

</body>

</html>