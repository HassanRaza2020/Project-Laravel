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

    <form action="{{ route('verification_otp')}}" method="post">
        @csrf
    
      @foreach ($user_info as $key => $value )

      <input type="hidden" name="user_info[{{$key}}]" value="{{$value}}">
          
      @endforeach    

        <div class="col-10 offset-sm margin-bottom-15">
            <label for="password">Enter the OTP Code</label>
            <input type="text" name="otpverification" class="form-control"  placeholder ="Enter OTP Code" required>
        </div>

        <button type="submit" id="submit" class="btn btn-outline-danger" name="login">Submit</button>
    </form>


    <form action="{{route('ResentOtp')}}" method="post">

     @csrf

        @foreach ($user_info as $key => $value )

        <input type="hidden" name="user_info[{{$key}}]" value="{{$value}}">
            
        @endforeach    

        <button type="submit" id="Resent" style="visibility:hidden;" onclick="OtpResent()" class="btn btn-outline-danger" name="Resent">Resent</button>


    </form>



    
</div>


<div id="timer" style="font-size: 20px; color: rgb(245, 35, 35);" class="timer"></div>

    <script>
       
        // End time from Laravel (passed as a server-side variable)
    let endTime = @json($endTime);
    console.log(endTime, "endtime");

    function updateTimer() {
        const now = Math.floor(Date.now() / 1000); // Current time in seconds
        console.log(now);

        const remainingTime = Math.floor(endTime-now);

        console.log(remainingTime, "Remaining Time in seconds");

        if (remainingTime > 0) {
            const minutes = Math.floor(remainingTime / 60);
            const seconds = remainingTime % 60;

            document.getElementById('timer').innerText =
                `${minutes}:${seconds.toString().padStart(2, '0')}`;
        } else {
            document.getElementById('timer').innerText = "Try Again, OTP Expired";
            clearInterval(timerInterval);

            document.getElementById("submit").style.visibility = 'hidden';
            document.getElementById("Resent").style.visibility = 'visible';
        }
    }

    const timerInterval = setInterval(updateTimer, 1000); // Update timer every second

    function OtpResent() {
        
        
        var currenttime = new Date();

        console.log(currenttime, "currenttime");

        const newEndTime = currenttime.setSeconds(currenttime.getSeconds() + 120); // Add 120 seconds (2 minutes)
         
        // Use the updated end time for the timer
        const updatedEndTime = new Date(newEndTime).getTime() / 1000; // Convert to seconds
        console.log(updatedEndTime, "newEndTime");

        // Reset the timer to the new end time
        endTime = updatedEndTime; // Update global endTime with new value

        // Show the Submit button and hide the Resent button
        document.getElementById("submit").style.visibility = 'visible';
        document.getElementById("Resent").style.visibility = 'hidden';

        // Reinitialize the countdown
        clearInterval(timerInterval);
        timerInterval = setInterval(updateTimer, 1000); // Restart the timer
    }

    // Resend OTP handler
    $(document).ready(function () {
        $("#Resent").on("click", function () {
            $.ajax({
                url: 'ResentOtp', // Laravel route for handling OTP resend
                method: 'POST',
                data: {
                    _token: '{{ csrf_token() }}' // Include CSRF token for security
                },
                success: function (response) {
                    // Update the timer logic after resending OTP
                    OtpResent();
                    console.log(response.message); // Optional: Display server response
                },
                error: function (error) {
                    console.error("Error resending OTP:", error);
                }
            });
        });
    });


    </script>




@endsection


</body>
</html>
