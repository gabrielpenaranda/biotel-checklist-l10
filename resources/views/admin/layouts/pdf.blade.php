<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <link rel="stylesheet" href="{{ public_path('vendor/bootstrap/bootstrap.min.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ public_path('css/custom.css') }}" type="text/css">
    <link rel="stylesheet" href="{{ public_path('vendor/fa/css/all.min.css') }}" type="text/css">
</head>
<body>
    <div id="app">
        @yield('content')
    </div>

</body>
</html>
