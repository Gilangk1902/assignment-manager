@extends('layouts.main')

@section('container')
    @guest
        <h1>hey, please login first before using our app!</h1>
    @else
        <h1>Hello {{ $user->name }}</h1>
        <h2>Your Favorites Boards</h2>
        <h1>----------------------------</h1>
        <h3><a href="/boards/{{ $user->id }}"> View Your Boards </a></h3>
    @endguest
    
    

@endsection   