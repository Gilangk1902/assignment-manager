@extends('layouts.main')

@section('container')

    <div class="container-lg">
        @if ($user_boards->isNotEmpty())
            <h1>{{ $user_boards->first()->user->name }}'s Boards</h1>

            <div class="row">
            @foreach ($user_boards as $board)
                <div class="col-6 col-xl-3 col-lg-4 mt-4">
                    <div class="card">
                        <div class="card-body text">
                            <h5 class="card-title" style="white-space: nowrap; width: 160px; overflow: hidden; text-overflow: ellipsis;">{{$board->title}}</h5>

                            <p class="card-text" style="white-space: nowrap; width: 160px; overflow: hidden; text-overflow: ellipsis;">{{$board->description}}</p>

                            <div class="d-flex justify-content-end">
                                <a href="/board/{{ $board->slug }}" class="btn btn-outline-primary" style="">Go to board</a>
                            </div>
                        </div>
                    </div>
                </div> 
            @endforeach
            </div>
        @else
            <h1> {{ Auth::user()->name }} doesn't have any boards yet. </h1>
            <p>you don't have any boards yet.</p>
        @endif
        {{-- Add New Board --}}
        <div class="card-header mt-4"> 
            @csrf
            <button id="add-new-board-button" type="submit" class="add-new-board-button btn btn-primary btn-sm"
            >+ Add New Board</button>
        </div>
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
    