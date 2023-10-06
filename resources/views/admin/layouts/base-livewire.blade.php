<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
    @section('styles')
        <link rel="stylesheet" href="{{ asset('vendor/bootstrap/bootstrap.min.css') }}">
       {{--  <link rel="stylesheet" href="{{ asset('css/app.css') }}"> --}}
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <link rel="stylesheet" href="{{ asset('vendor/fa/css/all.min.css') }}">
    @show

    @livewireStyles
</head>
<body>
    <div id="app">
        @include('admin.layouts._nav')
        @include('admin.layouts._errors')
        @include('admin.layouts._message')
        @include('sweetalert::alert')
        @include('admin.layouts._verify')
        @yield('content')
    </div>


    @livewireScripts
    @section('scripts')
        <script src="{{ asset('vendor/jquery/jquery-3.5.1.min.js') }}"></script>
        <script src="{{ asset('vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
        <script src="{{ asset('js/app.js') }}"></script>
        <script>
            $('.confirmation').on('click', function () {
                return confirm('Esta seguro de ejecutar esta acción?');
            });
        </script>
    @show


</body>
</html>
