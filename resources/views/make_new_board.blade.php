@extends('layouts.main')

@section('container')
<form>
  <div class="form-group">
    <label for="exampleInputEmail1">Board Title</label>
    <input class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter board name">
  </div>
  <div class="form-check">
    <input type="checkbox" class="form-check-input" id="exampleCheck1">
    <label class="form-check-label" for="exampleCheck1">Check me out</label>
  </div>
  <button type="submit" class="btn btn-primary">Submit</button>
</form>
@endsection