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
@endsection   
    