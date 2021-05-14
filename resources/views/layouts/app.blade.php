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

        <div class="container mx-auto bg-indigo-500 mt-8 rounded px-8 py-4 shadow">
            <h3 class="font-black text-white shadow-sm">Heads up!</h3>
            <p class="text-indigo-100 mt-1 leading-tight">This site is under heavy development at the moment. I hope to have it done in the near future here, but in the meantime, content will be lacking and there may be some empty pages. Let me know if something feels off, and thank you for being patient!</p>
        </div>

        {{-- Main content --}}
        <div class="container mx-auto mt-8 w-full bg-white shadow-lg rounded py-4 px-8">
            @yield('content')
        </div>

        {{-- AlpineJS --}}
        <script src="https://cdn.jsdelivr.net/gh/alpinejs/alpine@v2.8.2/dist/alpine.min.js" defer></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlight.js/10.7.2/highlight.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/highlightjs-line-numbers.js/2.8.0/highlightjs-line-numbers.min.js"></script>
        <script src="{{ mix('assets/js/app.js') }}"></script>
    </body>
</html>
