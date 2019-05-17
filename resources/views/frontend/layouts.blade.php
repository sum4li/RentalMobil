@php
    function setting($slug){
        return App\Setting::where('slug',$slug)->get()->first()->description;
    }
@endphp
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="author" content="digsa.id">
    <meta name="keywords" content="{{setting('keywords')}}, @yield('keywords')">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    {!! SEOMeta::generate() !!}

    {!! OpenGraph::generate() !!}
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title -->
    <title>{{setting('title')}} | Home</title>
    <!-- Favicon -->
    <link rel="icon" href="{{asset('frontend/img/brand/favicon.png')}}">
    <!-- Core Stylesheet -->
    <link href="{{asset('frontend/style.css')}}" rel="stylesheet">
    <!-- Responsive CSS -->
    <link href="{{asset('frontend/css/responsive.css')}}" rel="stylesheet">

</head>

<body>

    @include('frontend.component.header')
    @if (request()->route()->getName() == 'index.index')
        @include('frontend.component.slideshow')

        @include('frontend.component.service')

        @include('frontend.component.promo')

        @include('frontend.component.portofolio')

        @include('frontend.component.contact')

    @else
        @include('frontend.component.breadcrumb')

    @endif

    @yield('content')



    @include('frontend.component.footer')

    <!-- jQuery-2.2.4 js -->
    <script src="{{asset('frontend/js/jquery-2.2.4.min.js')}}" type="text/javascript"></script>
    <!-- Popper js -->
    <script src="{{asset('frontend/js/popper.min.js')}}" type="text/javascript"></script>
    <!-- Bootstrap js -->
    <script src="{{asset('frontend/js/bootstrap.min.js')}}" type="text/javascript"></script>
    <!-- All Plugins js -->
    <script src="{{asset('frontend/js/plugins.js')}}" type="text/javascript"></script>
    <!-- Active js -->
    <script src="{{asset('frontend/js/active.js')}}" type="text/javascript"></script>
    <!-- Google Maps -->
</body>

</html>
