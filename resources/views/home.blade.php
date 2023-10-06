@extends('layouts.main')

@section('container')
    <h1>Hemlo {{ $user->name }}, This is ur Boards</h1>
    <h3><a href="/profile/{{ $user->id }}">view ur profile bitch</a></h3>
    <h1>----------------------------</h1>
    <h3><a href="/boards/{{ $user->id }}"> Boards </a></h3>
@endsection   