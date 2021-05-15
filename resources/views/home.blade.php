@extends('layouts.app')

@section('title', 'Home')

@section('content')
    {{-- Header --}}
    <div class="grid grid-cols-1 md:grid-cols-6">
        <div class="col-span-2">
            <div class="bg-gradient-to-br from-indigo-500 to-blue-500 rounded w-4/5 mx-auto">
                <img src="{{ asset('assets/img/profile.jpg-full.webp') }}" srcset="{{ asset('assets/img/profile.jpg-third.webp') }} 1007w, {{ asset('assets/img/profile.jpg-half.webp') }} 1512w, {{ asset('assets/img/profile.jpg-full.webp') }} 3024w" sizes="100vw" class="p-1 shadow rounded-lg" alt="A picture of Braxton Fair on the MSU, Mankato campus">
            </div>
        </div>
        <div class="col-span-4 mt-8 md:mt-0 w-11/12 mx-auto flex flex-wrap content-center">
            <div>
                <h1 class="title">Hey! My name is <span class="title-accent">Braxton</span>.</h1>
                <p class="subtext">I am a {{ $birthdate->diffInYears() }} {{ $birthdate->isBirthday() ? '🎉' : '' }} year old student at <a href="https://mankato.mnsu.edu/" class="link" rel="noreferrer" target="_blank">Minnesota State University, Mankato</a>.
                    I am a double major in mathematics and computer science, studying operating systems and playing around with <a href="https://www.rust-lang.org/" class="link" rel="noreferrer" target="_blank">Rust</a>!
                Having fun tinkering with the lower levels of computers and the web, and writing about it. If you want to check out what I'm working on, look at my <a href="https://github.com/taxborn" class="link" rel="noreferrer" target="_blank">Github</a>
                 page or my <a href="{{ route('about') }}" class="link">about me</a> section!</p>
                <h3 class="subtitle mt-4">My mission statment.</h3>
                <p class="subtext">I want to take my studies at MSU, Mankato into real-world research and applications to solve real-world problems. I also want to facilitate effective communication and teamwork within that research and application.</p>

                <div class="mt-4">
                    <a class="px-4 py-2 text-md font-semibold tracking-wider border-2 border-indigo-300 rounded hover:bg-indigo-50 cursor-pointer text-indigo-600 hover:shadow focus:outline-none focus:ring-2 focus:ring-indigo-300 mr-2" href="{{ route('about') }}">About Me</a>
                    <a class="px-4 py-2 text-md font-semibold tracking-wider border-2 border-gray-300 rounded hover:bg-gray-50 cursor-pointer text-gray-600 focus:outline-none focus:ring-2 focus:ring-gray-300" rel="noreferrer" href="https://www.linkedin.com/in/taxborn/" target="_blank">LinkedIn</a>
                </div>
            </div>
        </div>
    </div>

    {{-- Divider --}}
    <hr class="divider"></hr>

    {{-- Blog posts --}}
    <div class="mx-auto w-11/12">
        <h3 class="title">My recent blog posts.</h3>
        <p class="subtext">I probably won't write much, but when I do, the newest will appear here.</p>

        @isset($posts)
            <div class="grid gap-4 grid-cols-1 md:grid-cols-{{ count($posts) }} mt-4">
                @foreach($posts as $post)
                    @include('includes.post-card')
                @endforeach
            </div>
        @endisset

        @empty($posts)
            <span class="muted">nothing to see here yet...</span>
        @endempty
    </div>
@endsection
