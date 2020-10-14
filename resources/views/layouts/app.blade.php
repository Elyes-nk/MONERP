<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <link rel="stylesheet" href=" {{ asset('css/main.css')}}">
    <link rel="stylesheet" href=" {{ asset('css/util.css')}}">
    @livewireStyles
</head>
<body onload="myFunction()">
<div id="preloader"></div>

<div class="limiter">
@yield('content')
</div>

@livewireScripts

<script>
        var preloader = document.getElementById("preloader");
        function myFunction(){
          preloader.style.display = 'none';
        };
</script>
</body>
</html>