<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Password</title>
    <link rel="icon" href="{{ asset('question.png') }}" type="image/png">


    @extends('layouts.app')
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body>

@include('header.navbar')

@section('content')

<div class="container">
    <h1 class="text-center">Create New Password</h1>
    
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
  



    <!-- Login Form -->
    <form action="{{route('confirm_password')}}" method="POST">
        @csrf
        @method('PUT')  
        <div class="col-10 offset-sm margin-bottom-15">
            <label for="password">Password</label>
            <input type="password" class="form-control" id="password" name="OldPassword" placeholder="Enter password" required>
        </div>
           
        <input hidden name="email" value="{{$email}}">

        <div class="col-10 offset-sm margin-bottom-15">
            <label for="password">Confirm Password</label>
            <input type="password" class="form-control" id="password" name="NewPassword" placeholder="Enter password" required>
        </div>

       
       
        <button type="submit" class="btn-primary" name="login">Create</button>
    </form>

</div>


@endsection


</body>
</html>
