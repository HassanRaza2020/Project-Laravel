@extends('layouts.app')
@section('title', 'Confirm Password')


@section('content')

<div class="container">
    <h1 class="text-center">Create New Password</h1>
    
    @if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif
  



    <!-- Login Form -->
    <form action="{{route('confirm-password')}}" method="POST">
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

