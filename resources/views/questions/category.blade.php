

<label for="category" class="form-label">Select Category</label>
  <select class="form-control" name="category" id="category" required>
<option value="" disabled selected>Select a category</option>

@foreach($categories as $category)

<option value="{{ $category->id }}">{{ $category->content_name }}</option>
    @endforeach
 </select>
