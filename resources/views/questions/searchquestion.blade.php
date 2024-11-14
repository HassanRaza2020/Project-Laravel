<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    @extends('layouts.app')
    @vite(['resources/css/app.css', 'resources/js/app.js'])

</head>
<body>
@include('header.navbar')





@if($search_questions->isEmpty())
    <p>No questions found.</p>
@else
    @foreach($search_questions as $title)
    <div class='question-list'>
  
  <a href="{{ route('show-answers', ['key' => $title->question_id]) }}">{{ $title->title }} </a>
    </div>
    @endforeach
@endif





    
</body>
</html>