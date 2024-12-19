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
    <h1 class="text-center">Forget Email</h1>

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

    <form action="" method="post">
        @csrf
   
        <div class="col-10 offset-sm margin-bottom-15">
            <label for="password">Enter your Email</label>
            <input type="text" name="otpverification" class="form-control"  placeholder ="Enter your email" required>
        </div>

        <button type="submit" id="submit" class="btn btn-outline-danger" name="login">Submit</button>
    </form>
