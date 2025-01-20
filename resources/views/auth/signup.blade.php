<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Laravel Project</title>
    <link rel="icon" href="{{ asset('question.png') }}" type="image/png">
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <script src="https://code.jquery.com/jquery-3.6.4.min.js" 
        integrity="sha384-UqK1C8MLj5lI9T5Re1VGhe93JgC/KjHg5OTmv7XtZljD0hJpHtv3jv9UjR6g/UuK" 
        crossorigin="anonymous"></script>
    
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
    <form action="{{route('signup')}}" method="POST">
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
    
        <button type="submit" class="btn btn-primary" name="signup">Submit</button>
    </form>
    
</div>



@endsection
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script>


    console.log("success");
    console.log(typeof $); // Should print 'function'

    $(document).ready(function () {
        $('#signupForm').on('submit', function (e) {
            e.preventDefault(); // Prevent default form submission
             alert("hewduh");
            // Gather form data
            let formData = {
    _token: 'ldIykAZRP0m4Ca9MKHGAXO7e46mVmKmj2MYwW0Sh', // Replace with the token you debugged
    username: $('#username').val(),
    email: $('#email').val(),
    password: $('#password').val(),
    password_confirmation: $('#password_confirmation').val(),
    address: $('#address').val(),};
    console.log('Form Data:', formData);



    $.ajax({
    url: "http://127.0.0.1:8000/post-signup",
    type: "POST", // Ensure this is POST
    data: {
        _token: $('meta[name="csrf-token"]').attr('content'), // Add CSRF token
        username: $('#username').val(),
        email: $('#email').val(),
        password: $('#password').val(),
        password_confirmation: $('#password_confirmation').val(),
        address: $('#address').val(),
    },
    success: function (response) {
        console.log('Response:', response);
    },
    error: function (xhr) {
        console.error('Error:', xhr);
    }});
     
        });
    });
</script>

    
    


</body>
</html>
