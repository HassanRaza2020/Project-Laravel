@include('header.navbar')
@section('Questions', 'Questions')
@extends('layouts.app')
@vite('resources/js/questions/question.js')
@section('content')

@if(session('status'))
<div class="alert alert-success">
    {{ session('status') }}
</div>
@endif

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



@php
$count=0
@endphp


<div class="container">

    <h1>Questions</h1>

    <p hidden>{{ $id = auth()->id() }} </p>

    @foreach ($questions as $question)
    <i>{{ $question->username }}</i>
    <div class="question-list">

        @php
        $encrypt_key = Crypt::encrypt($question->question_id);
        @endphp

        <a href="{{ route('show-answers', ['key' => urlencode($encrypt_key)]) }}">
            {{ $question->title }}
        </a>


        @if ($id === $question->user_id)
        <form action="{{ route('delete-question', ['questionKey' => $question->question_id]) }}" method="post">
            @csrf
            @method('DELETE')

            <button type="submit" class="delete-button">

                <svg width="20" height="17" class="bi-trash" viewBox="0 0 16 16">
                    <path
                        d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z" />
                    <path
                        d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z" />
                </svg>

            </button>

        </form>



        <button type="submit" id="open-modal{{++$count}}" class="delete-button" data-value={{$question->question_id}}>


            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pen"
                viewBox="0 0 16 16">
                <path
                    d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
            </svg>


        </button>





        <form action="{{ route('edit-question')}}" method="post">
            @csrf
            @method('PUT')

            <div class="modal" tabindex="-1" role="dialog" id="modal">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">

                            <input type="hidden" id="question-id-input" name="question_id">


                            <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close"
                                id="close-btn">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>

                        <div class="mb-2">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" required>
                        </div>

                        <div class="mb-2">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control" id="description" name="description" required></textarea>
                        </div>


                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary" style="margin-left:180px;">Save</button>
                            <button type="button" class="btn btn-secondary" data-dismiss="close-btn"
                                id="close-btn2">Close</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>



        @endif


        <p class="timestamp">{{ $question->created_at->format('g:i a') }}</p>
    </div>


    @endforeach

    <div id="count" data-end-time="{{$count}}"></div>



    @endsection