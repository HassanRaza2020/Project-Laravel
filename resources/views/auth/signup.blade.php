<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Project</title>
    <link rel="icon" href="{{ asset('question.png') }}" type="image/png">

    
    @extends('layouts.app')
    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body>


@include('header.navbar')


@section('content')
<div class="container text-align-center">
    <h1 class="heading">Sign Up</h1>

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

    <!-- Display Success Message -->
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <!-- Sign Up Form -->
    <form action="{{ route('signup') }}" method="POST">
        @csrf

        <div class="col-10 offset-sm margin-bottom-15">
            <label for="username">User Name</label>
            <input type="text" class="form-control" id="username" name="username" placeholder="Enter user name" required>
        </div>

        <div class="col-10 offset-sm margin-bottom-15">
            <label for="email">User Email</label>
            <input type="email" class="form-control" id="email" name="email" placeholder="Enter user email" required>
        </div>

        <div class="col-10 offset-sm margin-bottom-15">
            <label for="password">User Password</label>
            <input type="password" class="form-control" id="password" name="password" placeholder="Enter user password" required>
        </div>

        <div class="col-10 offset-sm margin-bottom-15">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" placeholder="Confirm your password" required>
        </div>

        <div class="col-10 offset-sm margin-bottom-15">
            <label for="address">User Address</label>
            <input type="text" class="form-control" id="address" name="address" placeholder="Enter user address" required>
        </div>

        <button type="submit" class="btn-primary" name="signup">Submit</button>
    </form>
</div>

@endsection

</body>
</html>
