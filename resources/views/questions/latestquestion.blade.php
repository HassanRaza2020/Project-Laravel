<!DOCTYPE html>
<html lang="en">

<head>

        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>@yield('title', 'Document')</title>
        <link rel="icon" href="{{ asset('question.png') }}" type="image/png">


        @vite(['resources/css/app.css', 'resources/js/app.js'])
        @extends('layouts.app')
</head>

<body>

        @include('header.navbar')
        <div class="container">
                <h1>Latest Questions</h1>

                @foreach ($questions as $question)
                @php
                $daysDifference = \Carbon\Carbon::parse($question->created_at)->diffInDays(now());
                @endphp
                @if ($daysDifference<1) <i>{{ $question->username }}</i><br>
                        <div class="question-list">
                                {{ $question->title }}
                                <p class="timestamp">{{$question->created_at->format('g:i a')}}</p>
                        </div>
                        @endif
                        @endforeach

        </div>
</body>

</html>
</body>