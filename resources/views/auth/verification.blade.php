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
    <h1 class="text-center">Verification</h1>

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

    <form action="{{ route('verification_otp')}}" method="Post">
        @csrf
    
      @foreach ($user_info as $key => $value )

      <input type="hidden" name="user_info[{{$key}}]" value="{{$value}}">
          
      @endforeach    

        <div class="col-10 offset-sm margin-bottom-15">
            <label for="password">Enter the Opt Code</label>
            <input type="text" name="otpverification" class="form-control"  placeholder ="Enter password" required>
        </div>

        <button type="submit" class="btn-primary" name="login">Enter</button>
    </form>

</div>


<div id="timer" style="font-size: 20px; color: rgb(245, 35, 35);" class="timer"></div>

    <script>
        // Get the end time from the controller
        const endTime = @json($endTime);

        function updateTimer() {
            const now = Math.floor(Date.now() / 1000); // Current time in seconds
            const remainingTime = endTime - now;

            if (remainingTime > 0) {
                const minutes = Math.floor(remainingTime / 60);
                const seconds = remainingTime % 60;
                document.getElementById('timer').innerText =
                    `${minutes}:${seconds.toString().padStart(2, '0')}`;
            } else {
                document.getElementById('timer').innerText = "Try Again, Otp Expired";
                clearInterval(timerInterval); // Stop the timer
            }
        }

        // Update the timer every second
        const timerInterval = setInterval(updateTimer, 1000);

        // Initialize the timer display
        updateTimer();
    </script>

















@endsection


</body>
</html>
