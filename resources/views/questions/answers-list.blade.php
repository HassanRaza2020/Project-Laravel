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

@php
    $count = 0
@endphp



    @if(session('status'))
    <div class="alert alert-success">
        {{ session('status') }}
    </div>
@endif



<p hidden> {{$USER_ID = auth()->id()}}</p>

<h3 class="answers">Answers</h3>
    

   @foreach($query as $answers)

         <div class="answer-section">
         <i>{{$answers->username}}</i>
         <div class='answer-list'>
         {{ $answers->Description }}


   @if ($USER_ID === $answers->user_id)

   <form action="{{route('delete-answer',  ['key' => $answers->answer_id, 'questionKey' => $question->question_id ]) }}" method="post">
   @csrf
   @method('DELETE')

   <button type="submit" class="delete-button">

        <svg width="16" height="16"  class="bi-trash" viewBox="0 0 16 16">
                    <path d="M5.5 5.5A.5.5 0 0   6 6v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m2.5 0a.5.5 0 0 1 .5.5v6a.5.5 0 0 1-1 0V6a.5.5 0 0 1 .5-.5m3 .5a.5.5 0 0 0-1 0v6a.5.5 0 0 0 1 0z"/>
                    <path d="M14.5 3a1 1 0 0 1-1 1H13v9a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V4h-.5a1 1 0 0 1-1-1V2a1 1 0 0 1 1-1H6a1 1 0 0 1 1 1h3.5a1 1 0 0 1 1 1zM4.118 4 4 4.059V13a1 1 0 0 0 1 1h6a1 1 0 0 0 1-1V4.059L11.882 4zM2.5 3h11V2h-11z"/>
        </svg>
    </button>

   </form>




<button type="submit" id="open-modal{{++$count}}" class="delete-button" data-value = {{$answers->answer_id}}>
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor"
        class="bi bi-pen" viewBox="0 0 16 16">
        <path
            d="m13.498.795.149-.149a1.207 1.207 0 1 1 1.707 1.708l-.149.148a1.5 1.5 0 0 1-.059 2.059L4.854 14.854a.5.5 0 0 1-.233.131l-4 1a.5.5 0 0 1-.606-.606l1-4a.5.5 0 0 1 .131-.232l9.642-9.642a.5.5 0 0 0-.642.056L6.854 4.854a.5.5 0 1 1-.708-.708L9.44.854A1.5 1.5 0 0 1 11.5.796a1.5 1.5 0 0 1 1.998-.001m-.644.766a.5.5 0 0 0-.707 0L1.95 11.756l-.764 3.057 3.057-.764L14.44 3.854a.5.5 0 0 0 0-.708z" />
    </svg>
</button>

<form action="{{ route('edit-answer')}}" method="post">
    @csrf
    @method('PUT')
                            
<div class="modal" tabindex="-1" role="dialog" id="modal">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">

            <input type="hidden" id="question-id-input" name="answer_id">


         <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close" id="close-btn">
         <span aria-hidden="true">&times;</span>
          </button>
        </div>
               
        
        <div class="mb-2">
            <label for="description" class="form-label">Answer</label>
            <textarea class="form-control" id="description" name="description" required></textarea>
        </div>
                               

         <div class="modal-footer">
          <button type="submit" class="save" style="margin-left:180px;">Save</button>
          <button type="button" class="btn-secondary" data-dismiss="close-btn" id="close-btn2">Close</button>
         </div>
         </div>
         </div>
         </div>                            
     </form>


@endif

<p class="timestamp">{{$answers->created_at->format('g:i a')}} <p>

        </div>
    </div>

   
@endforeach


@endsection




      <script>
        document.addEventListener('DOMContentLoaded', () => {
        let questionIdInput = document.getElementById('question-id-input');
        let modalButtonsArray = [];
        let modal = document.getElementById('modal');
        let closeModalButton = document.getElementById('close-btn');
        let closeModalButton2 = document.getElementById('close-btn2');

        // Loop through the buttons that trigger the modal
        for (let i = 1; i <= {{ $count }}; i++) {
            const openModalButton = document.getElementById('open-modal' + i);
            
            if (openModalButton) {
                modalButtonsArray.push(openModalButton); // Store the button in the array
            }
        }

        // Log the modal buttons array for debugging
        console.log(modalButtonsArray);

        // Event listeners for opening the modal
        modalButtonsArray.forEach(button => {
            button.addEventListener('click', function() {
                modal.style.display = "block"; // Show the modal
                let questionId = button.getAttribute('data-value'); // Get the questionId
                questionIdInput.value = questionId; // Set the value to the hidden input
                console.log(document.getElementById('question-id-input').value);
                console.log(questionId); // Log the questionId
            });
        });

        // Event listener to close the modal
        if (closeModalButton) {
            closeModalButton.addEventListener('click', function() {
                modal.style.display = "none"; // Hide the modal
            });
        }

        if (closeModalButton2) {
            closeModalButton2.addEventListener('click', function() {
                modal.style.display = "none"; // Hide the modal
            });
        }
    });
       
   </script>




</body>
</html>


