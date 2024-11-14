<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @extends('layouts.app')


</head>
<body>


@section('content')


<h3 class="answers">Answers</h3>
    

@foreach($query as $answers)


        


    <div class="answer-section">
        <i>{{$user}}</i>
        <div class='answer-list'>
            <h6>{{ $answers->Description }}</h6>
        </div>
    </div>

   
@endforeach


@endsection

</body>
</html>


