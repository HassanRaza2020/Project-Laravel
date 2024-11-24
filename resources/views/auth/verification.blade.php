<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    @extends('layouts.app')
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body>

@include('header.navbar')

@section('content')

<div class="container">
    <h1 class="text-center">Login</h1>

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

    <!-- Login Form -->
    <form action="{{ route('verification_otp')}}" method="POST">
        @csrf

        <div class="col-10 offset-sm margin-bottom-15">
            <label for="password">Enter the Opt Code</label>
            <input type="text" name="otpverification" class="form-control placeholder="Enter password" required>
        </div>

        <button type="submit" class="btn-primary" name="login">Enter</button>
    </form>

</div>
@endsection


</body>
</html>
