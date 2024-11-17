<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Questions')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>
    @extends('layouts.app')

    @include('header.navbar')

    @section('content')
    <div class="container">
        <h1>Questions</h1>
        @foreach($questions as $title)
        <i>{{ $title->username }}</i>
        <div class='question-list'>
            <a href="{{ route('show-answers', ['key' => $title->question_id]) }}">
                {{ $title->title }}
            </a>

            <a href="#" class="delete-link" id="{{ $title->question_id }}">
                <svg width="16" height="16" fill="currentColor" class="bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0 1 6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
                </svg>
            </a>

            <form id="delete-form-{{ $title->question_id }}" action="{{ route('DeleteQuestion', ['key' => $title->question_id]) }}" method="POST" style="display: none;">
                @csrf
                @method('DELETE')
            </form>
        </div>
        @endforeach
    </div>
    @endsection
</body>
<script>
    document.querySelectorAll('.delete-link').forEach(link => {
        link.addEventListener('click', function(e) {
            e.preventDefault();
            const id = this.id;
            if (confirm('Are you sure you want to delete this question?')) {
                const form = document.getElementById(`delete-form-${id}`);
                if (form) {
                    form.submit();
                } else {
                    console.error(`Delete form with id delete-form-${id} not found.`);
                }
            }
        });
    });
    console.log(`Clicked delete link for question ID: ${id}`);

</script>
</html>
