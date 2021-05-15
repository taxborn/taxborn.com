@extends('layouts.app')

@section('title', $post->title)

@section('content')
    <div class="blog-container">
        <h1 class="title title-accent text-center">{{ $post->title }} {!! $post->published ? '' : ' - <span class="font-black text-red-500">DRAFT</span>' !!}</h1>
        <h3 class="subtext text-center">{{ $post->author->name }} - {{ $post->publish_date->diffForHumans() }} - <span class="muted">{{ $estimatedTimeToRead }}</span></h3>

        @if ($post->tags->count() != 0)
            <div class="my-3 flex flex-wrap justify-center -m-1">
                @foreach ($post->tags as $tag)
                    <x-tag>
                        {{ $tag->name }}
                    </x-tag>
                @endforeach
            </div>
        @endif

        <hr class="divider"></hr>

        {!! $post->content !!}
    </div>
@endsection
