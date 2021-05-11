@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <h1 class="text-3xl text-indigo-500 text-center uppercase tracking-wide font-semibold">{{ $post->title }}</h1>

    <div class="w-full flex justify-center my-2">
        <div class="w-32 h-0.5 bg-gray-800"></div>
    </div>

    <h3 class="uppercase tracking-wide text-gray-500 text-center">{{ $post->author->name }} - {{ $post->publish_date->diffForHumans() }}</h3>

    <div class="blog-container">{!! $post->content !!}</div>
@endsection
