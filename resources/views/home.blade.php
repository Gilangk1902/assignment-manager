@extends('layouts.main')

@section('container')
    {{-- @guest
        <h1>hey, please login first before using our app!</h1>
    @else
        <h1>Hello {{ $user->name }}</h1>
        <h2>Your Favorites Boards</h2>
        <h1>----------------------------</h1>
        <h3><a href="/boards/{{ $user->id }}"> View Your Boards </a></h3>
    @endguest --}}

        
    <div class="position-absolute top-50 start-50 translate-middle text-center">
        @guest
            <div class="container">
                <div>
                    <h1>Managing your tasks just made easier with MyTasks</h1>
                </div>
                
                <div class="mt-3">
                    <h5>Sign up for FREE to use our services!</h5>
                </div>
    
                <a href="/register" class="btn btn-primary rounded-pill mt-3 fs-5 px-5 py-2">Sign up now</a>
            </div>

        @else
            <h1>Welcome, {{ $user->name }}!</h1>
            <p>What would you like to do today?</p>
            <div class="hstack gap-2 mt-4">
                <div>
                    <a href="/boards/{{ $user->id }}" class="btn btn-primary rounded-pill fs-5 px-4">
                        <i class="bi bi-view-stacked"></i>
                        View your boards
                    </a>
                </div>
                <div>
                    <a href="/make_new_board" class="btn btn-primary rounded-pill fs-5 px-4">
                        <i class="bi bi-plus-square"></i>
                        Create a new Board
                    </a>
                </div>
            </div>
        @endguest
        
    </div>
    
    
@endsection   