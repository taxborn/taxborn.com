@extends('layouts.app')

@section('title', 'Honors Program | Leadership')

@section('content')
        <h1 class="title">Leadership.</h1>
        <blockquote class="blockquote">Upon graduation, honors students will have demonstrated the ability to utilize personal leadership values and guide groups toward a common goal.</blockquote>

        <div class="bg-gray-200 shadow px-4 py-2 rounded my-4">
                <a class="text-2xl text-indigo-500 font-bold cursor-pointer" href="https://docs.google.com/document/d/1aLhxi2DUbvCbP2eNUgavO_xFWdgshtZWSxPXq3SVj9A/edit?usp=sharing" rel="noreferrer" target="_blank">
                    Leading My Team at Crocs
                    @include('includes.svg.document')
                </a>
            <p class="muted">Fall 2018 - Spring 2021</p>
            <p class="subtext my-2">I first was hired at Crocs back in fall of 2018. I started as a sales associate and didn’t entirely start out with the mindset
                 I was going to stick around. I only intended to stay for a few months and use it as a way of income for me to find a better and higher paying job
                 while I was in high school. However, within 3 months of starting, I was thrown into a position where I needed to lead. The management team at Crocs
                 decided to leave, and going without a manager or assistant manager at the store made me make more leadership decisions and help the store maintain
                 itself while we looked for a new manager. I remained a sales associate for about a year, where in December of 2019 I was promoted to a team leader.</p>
        </div>
@endsection
