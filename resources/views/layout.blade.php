<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('title')</title>
</head>
<body>

<div class="container mx-auto">
    @include('Navigation/navigation-bar')
    @vite('resources/css/app.css')
    @vite('resources/js/navbar.js')
    @yield('content')
</div>

</body>
</html>
