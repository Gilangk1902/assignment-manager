@extends('layouts.main')

@section('container')
    <h2>this your boards biatch</h2>
    <div class="row">
        @foreach ($user_boards as $board)
            <div class="">
                <div class="card" style="width: 18rem;">
                    <div class="card-body">
                        <h5 class="card-title">{{$board->title}}</h5>
                        <p class="card-text">{{$board->description}}</p>
                        <a href="/board/{{ $board->slug }}" class="btn btn-primary">Go to board</a>
                    </div>
                </div>
            </div> 
        @endforeach
    </div>
    {{-- Add New Board --}}
    <div class="card-header my-2"> 
        @csrf
        <button id="add-new-board-button" type="submit" class="add-new-board-button btn btn-primary btn-sm"
        >+ Add New Board</button>
    </div>

    <script>
        $(document).on('click', '.add-new-board-button', function(event){
            event.preventDefault();
            $.ajax({
                url: "/add-new-board",
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
    