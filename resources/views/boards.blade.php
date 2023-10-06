@extends('layouts.main')

@section('container')
    <h2>this your boards biatch</h2>
    @foreach ($user_boards as $board)
        <h3><a href="/board/{{ $board->slug }}">{{ $board->title }}</a></h2>
    @endforeach
@endsection   
    