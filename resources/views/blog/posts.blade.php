@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <div class="w-full bg-white shadow-lg rounded py-4 px-8">
        <h1 class="text-3xl font-semibold">My blog.</h1>
        <p class="mt-2">Here I plan to write blog posts that I think are cool and can either help myself or others. Have a look around!</p>
        @foreach ($posts as $post)
            @include('includes.post-card', ['post' => $post, 'loop' => $loop])
        @endforeach
    </div>
@endsection
