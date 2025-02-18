
    @section('content')




    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
    @endif
    

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
    <div class="information">
        <h4 style="font-family: cursive">{{$question->title}}</h4>

        <p style="font-family: cursive">{{$question->description}}</p>
    </div>
    <p hidden>{{ $id = auth()->id() }} </p>

    <div class="container">


        <form action="{{route('answer-submit')}}" method="POST">

            @csrf
            <!-- Hidden input field to pass the 'id' value -->
            <input type="hidden" name="question_id" value="{{ $question->question_id }}">

            <!-- Textarea for the user's answer -->
            <textarea placeholder="Your answer..." class="Description" name="answerfield" required ></textarea >

            <!-- Submit button -->
            <button class="answer-button" name="answer">Answer</button>
        </form>

        {{-- @if ($id != $question->user_id)

        <a href="{{route('direct-message', ['question_id' => $question->question_id, 
                                    'user_id'=>$question->user_id, 
                                    'username'=>$question->username,
                                    'title'=>$question->title,
                                    'time'=>$question->created_at->format('g:i a')])}}" style="text-decoration: none;">
            Answer the question privately</a>


        @endif --}}
    </div>




</body>

