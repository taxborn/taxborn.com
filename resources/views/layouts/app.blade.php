<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <meta name="description" content="A 19 year old mathematics and computer science student studying operating systems and playing around with Rust.">

        <title>taxborn.com | @yield('title')</title>

        {{-- tailwindcss --}}
        <link rel="stylesheet" href="{{ mix('assets/css/highlightjs.css') }}">
        <link rel="stylesheet" href="{{ mix('assets/css/app.css') }}">
    </head>

    <body class="bg-gray-100">
        {{-- Navigation bar --}}
        @include('includes.navigation')

        {{-- WIP Alert --}}
        <x-alert>
            <x-slot name="title">Heads up!</x-slot>

            This site is under heavy development at the moment. I hope to have it done in the near future here, but in the meantime,
            content will be lacking and there may be some empty pages. Let me know if something feels off, and thank you for being patient!
        </x-alert>

        {{-- Main content --}}
        <div class="container mx-auto mt-2 w-full bg-white shadow-lg rounded py-4 px-8">
            @yield('content')
        </div>

        {{-- AlpineJS --}}
        <script src="{{ mix('assets/js/app.js') }}"></script>
    </body>
</html>
