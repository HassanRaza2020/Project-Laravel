@extends('layouts.app')
@section('title', 'Sign Up')

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

<