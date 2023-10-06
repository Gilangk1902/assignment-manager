@extends('layouts.main')

@section('container')
    <h1>Hemlo {{ $username }}, This is ur Boards</h1>
    <h3><a href="/profile/{{ $id }}">view ur profile bitch</a></h3>
    <h1>----------------------------</h1>
    <h3><a href="/boards/{{ $id }}"> Boards </a></h3>
@endsection   