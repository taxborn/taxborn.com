@extends('layouts.app')

@section('title', 'Honors Program')

@section('content')
        <h1 class="title">Honors Program at <span class="title-accent">MSU, Mankato</span>.</h1>
        <blockquote class="blockquote">The Honors Program at Minnesota State University, Mankato is committed to supporting motivated undergraduate students by providing them with exceptional learning opportunities, mentoring relationships, and a supportive community that fosters their personal, academic, and professional development.</blockquote>

        <div class="bg-gray-200 shadow px-4 py-2 rounded mb-4">
            <a class="text-2xl text-indigo-500 font-bold cursor-pointer" href="https://docs.google.com/document/d/1qjcQ5maR8-TtVB0XjcjGuSd4KIfRpMrDJIPjLDAzNss/edit?usp=sharing" rel="noreferrer" target="_blank">Freshman year learning plan</a>
            <p class="muted">Fall 2020 - Summer 2021</p>
        </div>

        <div class="bg-gray-200 shadow px-4 py-2 rounded my-4">
            <a class="text-2xl text-gray-500 font-bold cursor-not-allowed" href="#" rel="noreferrer">Sophomore year learning plan</a>
            <p class="muted">Fall 2021 - Summer 2022</p>
        </div>

        <div class="bg-gray-200 shadow px-4 py-2 rounded my-4">
            <a class="text-2xl text-gray-500 font-bold cursor-not-allowed" href="#" rel="noreferrer">Junior year learning plan</a>
            <p class="muted">Fall 2022 - Summer 2023</p>
        </div>

        <div class="bg-gray-200 shadow px-4 py-2 rounded mt-4">
            <a class="text-2xl text-gray-500 font-bold cursor-not-allowed" href="#" rel="noreferrer">Senior year learning plan</a>
            <p class="muted">Fall 2023 - Summer 2024</p>
        </div>

@endsection
