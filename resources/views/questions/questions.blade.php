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

        <h1> Questions</h1>
   
     @foreach($questions as $title )

     
   <i>{{$title->username}}</i>  
   <div class='question-list'>
  
   <a href="{{ route('show-answers', ['key' => $title->question_id]) }}">
    {{ $title->title }} </a>

   
    </div>
   @endforeach



    </div>



    @endsection

</body>
</html>
