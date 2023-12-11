@extends('layouts.main')

@section('container')
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Board Title</label>
    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter board name">
  </div>
  <button type="submit" id="add-new-board-button" class="btn btn-primary">+ Add Board</button>
</form>

<script>
  $(document).on('click', '.add-new-board-button', function(event){
      event.preventDefault();
      $.ajax({
          url: "/add-new-board-with-title",
          type: "POST",
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          },
          success: function(response) {
              console.log("executed");
              location.reload();
          },
          error: function(error) {
             console.error(error);
          }
      });
  });
</script>
@endsection