
@extends('layouts.app')
@section('title', 'Forget Password')




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



    @if (session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif


    
    <!-- Login Form -->

    <form action="{{route('forget-password.redirect')}}" method="GET">
    @method("GET")
   
        <div class="col-10 offset-sm margin-bottom-15">
            <label for="password">Enter your Email</label>
            <input type="text" name="email" class="form-control"  placeholder ="Enter your email" required>
        </div>

        <button type="submit" id="submit" class="btn btn-outline-danger">Submit</button>
    </form>
