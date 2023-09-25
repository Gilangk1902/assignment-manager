@extends('layouts.main')

@section('container')
    <h2>this your boards biatch</h2>
    @foreach ($user_boards as $board)
        <h3><a href="/board/{{ $board["id"] }}">{{ $board["name"] }}</a></h2>
    @endforeach
@endsection   
    