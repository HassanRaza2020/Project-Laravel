

 function updateTimer() {
    
    let countdownElement = document.getElementById("countdown");
    let endTime = countdownElement.dataset.endTime;
    console.log("endtime:", endTime);
    
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

  
 // if (performance.navigation.type === 2) { // 2 means "Back/Forward" navigation
 //     window.location.href = "{{ route('view-signup') }}"; 
 // }