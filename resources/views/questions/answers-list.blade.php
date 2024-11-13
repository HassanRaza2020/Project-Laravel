<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
 
@if($user->isEmpty())
    <p>No users found.</p>
@else
    @php
        $count = 0;
    @endphp

    @foreach($user as $name)
        {{ $name->username }} {{ $count++ }}
    @endforeach
@endif



</body>
</html>


