
@extends('layouts.app')
@section('title', 'Ask Quuestion')

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



    <div class="container">
    <h1>Ask a Question</h1>

    <!-- Question Form -->
    <form action="{{ route('submit') }}" method="POST">
        @csrf

        <!-- Title Input -->
        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>

        <!-- Description Input -->
        <div class="mb-3">
            <label for="description" class="form-label">Description</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
        @include('questions.category')

        <!-- Submit Button -->
        <button type="submit" class="btn btn-primary">Ask</button>
    </form>
</div>
    @endsection

    
</body>
</html>
