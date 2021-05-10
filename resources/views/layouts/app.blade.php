<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>taxborn.com | @yield('title')</title>

        {{-- tailwindcss --}}
        <link rel="stylesheet" href="{{ asset('assets/css/app.css') }}">
    </head>
    <body>
        @yield('content')

        {{-- AlpineJS --}}
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
    </body>
</html>
