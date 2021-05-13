@extends('layouts.app')

@section('title', $post->title)

@section('content')

    <div class="blog-container">
        <h1 class="title title-accent text-center">{{ $post->title }}</h1>
        <h3 class="subtext text-center">{{ $post->author->name }} - {{ $post->publish_date->diffForHumans() }}</h3>

        <hr class="divider"></hr>

        {!! $post->content !!}
    </div>
@endsection
