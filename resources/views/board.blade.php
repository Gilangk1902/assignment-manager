@extends('layouts.main')

@section('container')
<h1>
    hey {{ $board->user->name}} this your {{ $board->title }} Board
</h1>

<div class="row">
    @foreach($board->groups as $group)
    <div class="card me-2" style="width: 18rem;">
    <h5 class="card-title">{{$group->title}}</h5>
    <div class="card-body">
        @foreach($group->tasks as $task)
        <div class="card-header my-2">
            <p class="d-inline">{{$task->title}}</p>
                <div class="d-inline justify-content-end">
                    <div class="d-inline">
                        <form method="POST" action="/send-left/{{$board->id}}/{{$group->id}}/{{ $task->id }}">
                            @csrf
                            <button id="refresh-page" type="submit" class="btn btn-primary btn-sm"> < </button>
                        </form>
                    </div>
                    <div class="d-inline">
                        <form method="POST" action="/delete/{{$board->id}}/{{$group->id}}/{{ $task->id }}}">
                            @csrf
                            <button id="refresh-page" type="submit" class="btn btn-primary btn-sm"> X </button>
                        </form>
                    </div>
                    <div class="d-inline">
                        <form method="POST" action="/send-right/{{$board->id}}/{{$group->id}}/{{ $task->id }}}">
                            @csrf
                            <button id="refresh-page" type="submit" class="btn btn-primary btn-sm"> > </button>
                        </form>
                    </div>
                </div>
        </div>
        @endforeach
    </div>
    </div>
    <!-- <h3>{{$group->title}}</h3>
    <ul>
        @foreach($group->tasks as $task)
        <li>{{$task->title}}</li>   
        @endforeach
    </ul> -->
    @endforeach
    <div>
        <div class="card-header my-2"> 
            <a href="#">+ Add New Group</a>
        </div>
    </div>
</div>
@endsection