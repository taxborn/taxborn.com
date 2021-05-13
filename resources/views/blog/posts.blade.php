@extends('layouts.app')

@section('title', 'Blog')

@section('content')
    <div class="w-full bg-white shadow-lg rounded py-4 px-8">
        <h1 class="title">My blog.</h1>
        <p class="subtext">Here I plan to write blog posts that I think are cool and can either help myself or others. Have a look around!</p>

        <hr class="divider"></hr>

        @isset($posts)
            <div class="grid gap-4 grid-cols-1 md:grid-cols-{{ count($posts) > 2 ? '3' : '1' }} mt-6">
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
