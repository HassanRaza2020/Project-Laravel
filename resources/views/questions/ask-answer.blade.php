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

    @section('content')


<div class="information">
<h4 style="font-family: cursive"  >{{$question->title}}</h4>

<p style="font-family: cursive">{{$question->Description}}</p>

</div>


<div class="container">

    
<form  action="{{route('answer-submit')}}" method="POST">

@csrf
<!-- Hidden input field to pass the 'id' value -->
<input type="hidden" name="question_id" value="{{ $question->question_id }}">

<!-- Textarea for the user's answer -->
<textarea  placeholder="Your answer..." class="Description" name="Description"></textarea>

<!-- Submit button -->
<button class="answer-button" name="answer">Answer</button>
</form>


</div>




</body>
</html>
