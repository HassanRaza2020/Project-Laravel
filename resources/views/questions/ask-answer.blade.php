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


<div class="container">


    
<form action="" method="POST">

<!-- Hidden input field to pass the 'id' value -->
<input type="hidden" name="id" value="">

<!-- Textarea for the user's answer -->
<textarea placeholder="Your answer..." class="form-control" name="Description"></textarea>

<!-- Submit button -->
<button class="btn-answer" name="answer">Answer</button>
</form>


</div>
 

    @endsection



</body>
</html>
