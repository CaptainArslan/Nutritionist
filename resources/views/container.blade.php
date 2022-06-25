<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1">
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{asset('/css/style.css')}}">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('/images/favicon.png')}}">
    <link rel="stylesheet" href="{{asset('/vendor/owl-carousel/css/owl.carousel.min.css')}}">
    <link rel="stylesheet" href="{{asset('/vendor/owl-carousel/css/owl.theme.default.min.css')}}">

    <!-- Font Awesome -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <script src="https://kit.fontawesome.com/c3e204ff59.js" crossorigin="anonymous"></script>

    <!-- jquery -->
    <script src="{{asset('./js/jquery-3.6.0.min.js')}}"></script>

    <!-- sweetalert -->
    <script src="{{asset('./js/sweetalert.min.js')}}"></script>

    <!-- Datatable -->
    <link rel="stylesheet" href="{{asset('./css/datataablescss.css')}}">
    <link rel="stylesheet" href="{{asset('./css/buttons.dataTables.min.css')}}">



</head>

<body class="antialiased">

@php 
    
@endphp
    <div id="main-wrapper">
        <x-header />
        <x-sidebar />
        <div class="content-body">
            @if (Session::get('fail'))
            <script>
                swal("Error", "{!! Session::get('fail') !!}", "warning");
            </script>
            @endif
            @if (Session::get('success'))
            <script>
                swal("Congratulation", "{!! Session::get('success') !!}", "success");
            </script>
            @endif
            @section('content-body')
            @show()
        </div>
        <x-footer />
    </div>
    <!-- Scripts -->
    <script>
        $(document).ready(function() {
            
        });
    </script>

    <script src="{{asset('./vendor/global/global.min.js')}}"></script>
    <script src="{{asset('./js/quixnav-init.js')}}"></script>
    <script src="{{asset('./js/custom.min.js')}}"></script>
    <!-- Owl Carousel -->
    <!-- <script src="{{asset('./vendor/owl-carousel/js/owl.carousel.min.js')}}"></script> -->



    <!-- Datatable -->
    <!-- <script src="//cdn.datatables.net/1.11.4/js/jquery.dataTables.min.js"></script> -->
    <script src="{{asset('./js/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('./js/dataTables.buttons.min.js')}}"></script>
    <script src="{{asset('./js/datatablesbuttons.html5.min.js')}}"></script>
    <script src="{{asset('./js/datatablesbuttons.print.min.js')}}"></script>
    <script src="{{asset('./js/datatablesjszip.min.js')}}"></script>
    <script src="{{asset('./js/datatablespdfmake.min.js')}}"></script>
    <script src="{{asset('./js/datatablesvfs_fonts.js')}}"></script>

</body>

</html>