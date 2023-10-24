@extends('layouts.main')

@section('container')
    @guest
        <h1>hey, please login first before using our app!</h1>
    @else
        <h1>Henlo {{ $user->name }}, This is ur Boards</h1>
        <h1>Bryan was here</h1>
        <h1>----------------------------</h1>
        <h3><a href="/boards/{{ $user->id }}"> View Your Boards </a></h3>
    @endguest
    
@endsection   