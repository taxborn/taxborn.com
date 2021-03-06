@extends('layouts.app')

@section('title', 'About')

@section('content')
    <div class="grid grid-cols-1 md:grid-cols-2">
        <div class="bg-gradient-to-br from-indigo-500 to-blue-500 rounded w-11/12 mx-auto">
            <img src="{{ asset('assets/img/me-and-mickey-full.webp') }}" width="3088" height="2316" srcset="{{ asset('assets/img/me-and-mickey-full.webp') }} 3088w, {{ asset('assets/img/me-and-mickey-half.webp') }} 1544w, {{ asset('assets/img/me-and-mickey-third.webp') }} 1028w" sizes="100vw" class="p-1 shadow rounded-lg" alt="Picture of my girlfriend and I">
        </div>
        <div class="order-first md:order-last mb-4 md:mb-0">
            <h1 class="title">Hey there!</h1>
            <p class="subtext">Lorem ipsum dolor sit amet consectetur adipisicing elit. Suscipit, labore deserunt temporibus dolor magnam voluptatum odio eum explicabo nesciunt veniam rerum neque itaque mollitia, voluptatem magni minus aliquid ad laudantium.</p>
        </div>
    </div>
@endsection
