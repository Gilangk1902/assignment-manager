@extends('layouts.main')

@section('container')
<h1>
    {{ $board->title }}
</h1>
<button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#edit-board-title-modal" data-board-id="{{ $board->id }}" data-board-title="{{ $board->title }}">
    edit
</button>

<div class="row">
    {{-- groups --}}
    @foreach($board->groups as $group)
    <div class="card me-2" style="width: 20rem;">
        <div class="row">
            <p class="card-title mt-3 mx-2 col fs-4">{{$group->title}}</p>
            <button type="button" class="btn btn-primary mt-3 mx-2 col-2" data-bs-toggle="modal" data-bs-target="#edit-group-title-modal" data-group-id="{{ $group->id }}" data-group-title="{{ $group->title }}">
                Edit
            </button>
            <div class="mt-3 mx-2 col-2">
                <form method="POST" action="/delete-group/{{$board->id}}/{{$group->id}}">
                    @csrf
                    <button id="refresh-page" type="submit" class="btn btn-primary"> X </button>
                </form>
            </div>
        </div>
        <div class="card-body">
            {{-- tasks --}}
            @foreach($group->tasks as $task)
            <div class="card-header my-2 mx-0 px-0">
                <div class="row ">
                    <p class="col m-2 mx-3">{{$task->title}}</p>
                    {{-- edit button --}}
                    <button type="button" class="btn btn-primary btn-sm col-2" data-bs-toggle="modal" data-bs-target="#edit-task-title-modal" 
                        data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}">
                        Edit
                    </button>
                    {{-- manage task buttons --}}
                    <div class="col">
                        <div class="row">
                            <div class="col-3">
                                @csrf
                                <button id="left-button" type="submit" class="left-button btn btn-primary btn-sm" 
                                        data-board-id="{{$board->id}}" data-group-id="{{$group->id}}" data-task-id="{{$task->id}}"> < </button>
                            </div>
                            <div class="col-3">
                                @csrf
                                <button id="delete-button" type="submit" class="delete-button btn btn-primary btn-sm"
                                        data-board-id="{{$board->id}}" data-group-id="{{$group->id}}" data-task-id="{{$task->id}}"> X </button>
                            </div>
                            <div class="col-3">
                                @csrf
                                <button id="right-button" type="submit" class="right-button btn btn-primary btn-sm"
                                        data-board-id="{{$board->id}}" data-group-id="{{$group->id}}" data-task-id="{{$task->id}}"> > </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Add New Task --}}
            <div>
                <div class=""> 
                    <button id="add-new-task-button" type="submit" class="add-new-task-button btn btn-primary btn-sm"
                    data-board-id="{{ $board->id }}" data-group-id="{{ $group->id }}">+ Add New Task</button>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div>
        {{-- Add New Group --}}
        <div class="card-header my-2"> 
            @csrf
            <button id="add-new-group-button" type="submit" class="add-new-group-button btn btn-primary btn-sm"
                data-board-id="{{ $board->id }}">+ Add New Group</button>
        </div>
    </div>
</div>
  
<!-- Edit Board Modal -->
<div class="modal fade" id="edit-board-title-modal" tabindex="-1" role="dialog" aria-labelledby="edit-board-title-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit-board-title-modal-label">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="edit-board-form" method="POST" action="">
                    @csrf
                    <input type="hidden" name="board_id" id="board-title-id">
                    <div class="mb-3">
                        <label for="board-input-title" class="form-label">Title</label>
                        <input type="text" class="form-control" id="board-input-title" name="board-input-title">
                    </div>
                    <button type="submit" class="btn btn-primary" id="update-board-button" action="">Submit</button>
                </form>
            </div>
        {{-- Footer --}}
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
      </div>
    </div>
</div>

<!-- Edit Group Modal -->
<div class="modal fade" id="edit-group-title-modal" tabindex="-1" role="dialog" aria-labelledby="edit-group-title-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit-group-title-modal-label">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form id="edit-group-form" method="POST" action="">
                @csrf
                <input type="hidden" name="group_id" id="group-title-id">
                <div class="mb-3">
                  <label for="group-input-title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="group-input-title" name="group-input-title">
                </div>
                <button type="submit" class="btn btn-primary" id="update-group-button" action="">Submit</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<!-- Edit Task Modal -->
<div class="modal fade" id="edit-task-title-modal" tabindex="-1" role="dialog" aria-labelledby="edit-task-title-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit-task-title-modal-label">Edit</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
        <div class="modal-body">
            <form id="edit-task-form" method="POST" action="">
                @csrf
                <input type="hidden" name="task_id" id="task-title-id">
                <div class="mb-3">
                  <label for="task-input-title" class="form-label">Title</label>
                  <input type="text" class="form-control" id="task-input-title" name="task-input-title">
                </div>
                <button type="submit" class="btn btn-primary" id="update-task-button">Submit</button>
              </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
</div>

<script src="{{ asset('js/board.js') }}"></script>

@endsection