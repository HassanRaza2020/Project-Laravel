<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Document')</title>


    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @extends('layouts.app')


</head>
<body>
    @include('header.navbar')

  


    <div class="container">

        <h1>Latest Questions</h1>
        @if($timestamp->DiffInDays()===1)
        @foreach ($questions as $question)

        <i>{{ $question->username }}</i>
        <div class="question-list">
        <a> {{ $question->title }}</a>
        <p class="timestamp">{{ $question->created_at->format('g:i a') }}</p> 

        </div>
        @endforeach
        @endif
 
    </div>

  
</body>
</html>
</body>