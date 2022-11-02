<?php
$objUser = \Illuminate\Support\Facades\Auth::user();
// dd($objUser)
?>
<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]> <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]> <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]> <!-->
<html lang="zxx">
<!--
<![endif]-->


<!-- Mirrored from santhemes.com/tidytheme/aducat/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Jul 2022 06:00:22 GMT -->
<head>
    <!-- TITLE OF SITE -->
    <title>Aducat - eLearning Education HTML5 Responsive Template</title>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="Fizxila - eLearning Education HTML5 Responsive Template" />
    <meta name="keywords"
        content="Aducat, Education, Learning, one page, multipage, responsive, courses, html template" />
    <meta name="author" content="Aducat">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

    <!-- Favicons -->
    <link rel="icon" type="image/png" href="{{asset('client/images/favicon.png')}}">


    <!-- CSS Begins
================================================== -->
    <!--Animate Effect-->
    <link href="{{asset('client/css/animate.css')}}" rel="stylesheet">
    <link href="{{asset('client/css/hover.css')}}" rel="stylesheet">

    <!-- For Image Preview -->
    <link rel="stylesheet" href="{{asset('client/css/magnific-popup.css')}}">

    <!--Owl Carousel -->
    <link href="{{asset('client/css/owl.carousel.css')}}" rel="stylesheet">

    <link rel="stylesheet" href="{{asset('client/css/slick.css')}}">

    <!--BootStrap -->
    {{-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> --}}
    {{-- <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script> --}}
    <link href="{{asset('client/css/bootstrap.min.css')}}" rel="stylesheet">
    <link href="{{asset('client/css/normalize.css')}}" rel="stylesheet">

    <!-- Main Style -->
    <link href="{{asset('client/css/style.css')}}" rel="stylesheet">
    <link href="{{asset('client/css/responsive.css')}}" rel="stylesheet">

    {{-- <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js" integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/respond.js/1.4.2/respond.min.js"></script> --}}
    <style>
        a {
        text-decoration: none;
        }

        #navigation {
        font-family: monospace;
        }
        .name {       
        outline: none;
        }

        ul li:hover > ul,
        ul li:focus-within > ul,
        ul li ul:hover,
        ul li ul:focus {
        visibility: visible;
        opacity: 1;
        display: block;
        }

        ul li ul li {
        clear: both;
        width: 100%;
        }
    </style>
</head>

<body>

    <!-- ::::::::::::::::::::::::::: Start: Preloader section ::::::::::::::::::::::::::: -->
    <div id="preloader"></div>
    <!-- ::::::::::::::::::::::::::: End: Preloader section ::::::::::::::::::::::::::: -->

    <!-- Start: Header Section
==================================================-->
        <header>
            @include('client.templates.header')
        </header>
    <!-- End: header navigation
==================================================-->

        <main>
            <div class="content">
                @yield('content')
        </div>
    </main>
    <!-- Start:Footer Section
==================================================-->
        <footer>
            @include('client.templates.footer')
        </footer>
    <!-- End:Footer Section
========================================-->


    <!-- Scripts
========================================-->
    <!-- jquery -->
    <script src="{{asset('client/js/jquery-1.12.4.min.js')}}"></script>
    <!-- plugins -->
    <script src="{{asset('client/js/plugins.js')}}"></script>
    <!-- Bootstrap -->
    <script src="{{asset('client/js/bootstrap.min.js')}}"></script>
    <script src="{{asset('client/js/slick.min.js')}}"></script>
    <script src="{{asset('client/js/jquery.stellar.min.js')}}"></script>


    <!-- Custom Scripts
========================================-->
    <script src="{{asset('client/js/main.js')}}"></script>

</body>


<!-- Mirrored from santhemes.com/tidytheme/aducat/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Mon, 18 Jul 2022 06:00:22 GMT -->
</html>