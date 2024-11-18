<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Questions')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="{{ asset('js/app.js') }}"></script>

</head>
<body>
    @extends('layouts.app')

    @include('header.navbar')

    @section('content')
    <div class="container">
        <h1>Questions</h1>
        
<p hidden>{{$id = auth()->id()}} </p>


        @foreach($questions as $question)
        <i>{{ $question->username }}</i>
        <div class="question-list">
            <a href="{{ route('show-answers', ['key' => $question->question_id]) }}">
                {{ $question->title }}
            </a>


@if($id === $question->user_id)

<form action="{{route('DeleteQuestion',  ['key' => $question->question_id])}}" method="post">
@csrf
@method('DELETE')

<button type="submit" class="delete-button">
       

        <svg width="20" height="17"  class="bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
        </svg>
    </button>

</form>

@endif


<p class="timestamp">{{$question->created_at->format('g:i a')}}</p>


        
        </div>
        @endforeach
    </div>
    @endsection
</body>


</script>
</html>
