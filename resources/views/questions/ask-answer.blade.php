<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Question')</title>
    <link rel="icon" href="{{ asset('question.png') }}" type="image/png">



    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @extends('layouts.app')


</head>

<body>
    @include('header.navbar')

    @section('content')



    <!-- Display Validation Errors -->
    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif




    <div class="information">
        <h4 style="font-family: cursive">{{$question->title}}</h4>

        <p style="font-family: cursive">{{$question->description}}</p>



    </div>
    <p hidden>{{ $id = auth()->id() }} </p>


    <div class="container">


        <form action="{{route('answer-submit')}}" method="POST">

            @csrf
            <!-- Hidden input field to pass the 'id' value -->
            <input type="hidden" name="question_id" value="{{ $question->question_id }}">

            <!-- Textarea for the user's answer -->
            <textarea placeholder="Your answer..." class="Description" name="Description"></textarea>

            <!-- Submit button -->
            <button class="answer-button" name="answer">Answer</button>
        </form>

        {{-- @if ($id != $question->user_id)

        <a href="{{route('direct-message', ['question_id' => $question->question_id, 
                                    'user_id'=>$question->user_id, 
                                    'username'=>$question->username,
                                    'title'=>$question->title,
                                    'time'=>$question->created_at->format('g:i a')])}}" style="text-decoration: none;">
            Answer the question privately</a>


        @endif --}}
    </div>




</body>

</html>