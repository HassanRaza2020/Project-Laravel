



@section('content')




<form action="{{ route('edit_question', ['key' => $question->question_id]) }}" method="post">
  @csrf
  @method('PUT')


<div class="modal" tabindex="-1" role="dialog" id="modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">

        <button type="button" class="close-btn" data-dismiss="modal" aria-label="Close" id="close-btn">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
             
      <div class="mb-2">
          <label for="title" class="form-label">Title</label>
          <input type="text" class="form-control" id="title" name="title" required>
      </div>

      <div class="mb-2">
          <label for="description" class="form-label">Description</label>
          <textarea class="form-control" id="description" name="description" required></textarea>
      </div>
     


      <div class="modal-footer">
        <button type="submit" class="btn btn-primary">Save </button>
        <button type="button" class="btn btn-secondary" data-dismiss="close-btn" id="close-btn">Close</button>
      </div>
    </div>
  </div>
</div>


</form>


@endsection