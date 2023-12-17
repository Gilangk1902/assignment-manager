@extends('layouts.main')

@section('container')
<form method="post" action="{{ route('add-new-board-with-title') }}">
  @csrf
  <div class="form-group">
      <label for="boardTitle">Board Title</label>
      <input class="form-control" id="boardTitle" name="title" aria-describedby="emailHelp" placeholder="Enter board name">
  </div>
  <button type="submit" id="add-new-board-button" class="btn btn-primary">+ Add Board</button>
</form>

<script>
</script>
@endsection