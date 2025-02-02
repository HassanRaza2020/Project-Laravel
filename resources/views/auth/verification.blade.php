@extends('layouts.app')
@section('title', 'Verifications')
@vite('resources/js/authentication/verification.js')


    @include('header.navbar')

    @section('content')

    <div class="container">
    <h1 class="text-center">Verification</h1>

    <!-- Display Validation Errors -->
  <!-- Display Validation Errors -->


  @if (session()->has('errors'))
  <div class="alert alert-danger">
      <ul>
          {{session('errors')}}
      </ul>
  </div>
@endif


    <form action="{{ route('verification-otp')}}" method="POST">

    @csrf
       
    @if (!empty($userinfo) && is_array($userinfo))
    @foreach ($userinfo as $key => $value)
        <input type="hidden" name="userinfo[{{ $key }}]" value="{{ $value }}">
    @endforeach
   
    @endif

        <div class="col-10 offset-sm margin-bottom-15">
            <label for="password">Enter the OTP Code</label>
            <input type="text" name="otpverification" class="form-control"  placeholder ="Enter OTP Code" required>
        </div>

        <button type="submit" id="submit" class="btn btn-outline-danger" name="login">Submit</button>
    </form>
       
    <form action="{{ route('resend-otp') }}" method="POST">
     @csrf
   
       <input type="hidden" name="userinfo" value="{{json_encode($userinfo, true)}}" />
    
        <button type="submit" id="Resent" style="visibility:hidden;" onclick="OtpResent()" class="btn btn-outline-danger" name="Resent">Resent</button>

    </form>

    </div>
    <div id="countdown" data-end-time="{{ $endTime }}"></div>

    <div id="timer" style="font-size: 20px; color: rgb(245, 35, 35);" class="timer"></div>
   

@endsection
