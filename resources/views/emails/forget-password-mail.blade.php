
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verification</title>

    @extends('layouts.app')
    @vite(['resources/css/app.css', 'resources/js/app.js'])


</head>
<body>


@section('content')

<div class="container">
 
  <img src="https://cdn.pixabay.com/photo/2012/04/02/16/13/question-24851_640.png" alt="Brand Logo" style="width: 70px; height: 70px;">

    <div class="card p-6 p-lg-10 space-y-4">
    <h3 class="h3 fw-700" style="font-family: cursive">
    Hi,{{$name}}      
    </h3>
    <a href="{{ $link }}" style="text-decoration: none;">Please click here to create new password</a>
    </div>



@endsection


</body>
</html>
