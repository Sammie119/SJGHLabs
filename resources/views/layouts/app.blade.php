<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
<html lang="en">

<head>
<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <link rel="shortcut icon" href={{ asset("public/img/logo_icon.ico") }}>

    <!-- Bootstrap Core CSS -->
    <link href={{ asset("public/css/bootstrap.min.css")}} rel='stylesheet'>

    <!--font-awesome--->
    <link rel="stylesheet" href={{ asset("public/font-awesome/css/font-awesome.min.css")}}>


    <!-- Custom CSS -->
  	{{-- <link rel="stylesheet" href={{ asset("public/css/main.css")}}>
    <link href={{ asset("public/css/custom.css")}} rel="stylesheet"> --}}
	
	
	<script src={{ asset("public/js/modernizr-2.6.2-respond-1.1.0.min.js")}}></script>


    <style type="text/css">

        #logo2{
            margin-top: 2px;
            float: left;
        }

        a{
            color: red;
            text-decoration:none;
            outline: 0;
        }
        a:hover {
          color: blue;
          text-decoration:none;
          outline: 0;
        }
    </style>

<link href={{ asset("public/css/bootstrap.min.css' rel='stylesheet")}}>
<script>window.jQuery || document.write('<script src={{ asset("public/js/jquery-3.6.0.min.js")}}><\/script>')</script>
<body>
    @include('layouts.nav-sidebar')

    @yield('content')

    {{-- Footer --}}   
    @include('layouts.timeout')
    {{-- End Footer --}}

    <script src={{ asset("public/js/jquery.js") }}></script>
    {{-- <script src={{ asset("public/js/jquery-1.9.1.min.js") }}></script> --}}
    {{-- <script src={{ asset("public/js/jquery-3.6.0.min.js") }}></script> --}}
    

    <script type='text/javascript' src={{ asset('public/js/jquery.min.js') }}></script>
    <script type='text/javascript' src={{ asset('public/js/popper.min.js') }}></script>
    <script type='text/javascript' src={{ asset('public/js/bootstrap.min.js') }}></script>
    <script src={{ asset("public/js/jquery.mask.js") }}></script>

    <script>
        $(".alert").fadeTo(2000, 500).slideUp(500, function(){
            $(".alert").slideUp(500);
        });
    </script>
    
</body>

</html>