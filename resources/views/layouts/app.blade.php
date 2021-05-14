<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">

        <title>taxborn.com | @yield('title')</title>

        {{-- tailwindcss --}}
        <link rel="stylesheet" href="{{ mix('assets/css/highlightjs.css') }}">
        <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
    </head>

    <body class="bg-gray-100">
        {{-- Navigation bar --}}
        @include('includes.navigation')

        @include('includes.alert')

        {{-- Main content --}}
        <div class="container mx-auto mt-2 w-full bg-white shadow-lg rounded py-4 px-8">
            @yield('content')
        </div>

        {{-- AlpineJS --}}
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlightjs-line-numbers.js/2.8.0/highlightjs-line-numbers.min.js"></script>
        <script src="{{ mix('assets/js/app.js') }}"></script>
    </body>
</html>
