@extends('layouts.main')

@section('container')
<script src="{{ asset('js/board.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">

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
        
        <div class="card-body" id="tasks-container">
            @foreach($group->tasks as $task)
                <!-- Other task HTML elements... -->

                @livewire('task-movement', ['boardId' => $board->id, 'groupId' => $group->id, 'board' => $board, 'group' => $group, 'task'=>$task], key($board->id.$group->id.$task->id))

                <!-- Other task HTML elements... -->
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

<!-- Move Task Modal -->
<div class="modal fade move-task-modal custom" id="move-task-modal" tabindex="-1" role="dialog" aria-labelledby="move-task-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="edit-task-title-modal-label">Move Task</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                
                <form id="move-task-form" wire:submit.prevent="moveTask">
                    @csrf
                    <input type="hidden" name="board_id" id="move-board-id" wire:model="boardId">
                    <input type="hidden" name="group_id" id="move-group-id" wire:model="groupId">
                    <input type="hidden" name="task_id" id="move-task-id" wire:model="taskId">


                    <div class="col-3">
                        <button id="left-button" type="button" class="left-button btn btn-primary btn-sm" wire:click="SendLeft({{ $board->id }}, {{ $group->id }}, {{ $task->id }})"> < </button>
                    </div>
                    <div class="col-3">
                        <button id="right-button" type="button" class="right-button btn btn-primary btn-sm" wire:click="SendRight({{ $board->id }}, {{ $group->id }}, {{ $task->id }})"> > </button>
                    </div>
                    <div class="col-3">
                        <button id="up-button" type="button" class="up-button btn btn-primary btn-sm" wire:click="SendUp({{ $board->id }}, {{ $group->id }}, {{ $task->id }})"> ^ </button>
                    </div>
                    <div class="col-3">
                        <button id="down-button" type="button" class="down-button btn btn-primary btn-sm" wire:click="SendDown({{ $board->id }}, {{ $group->id }}, {{ $task->id }})"> v </button>
                    </div>
                    <div class="col-3">
                        <button id="delete-button" type="button" class="delete-button btn btn-primary btn-sm" wire:click="DeleteTask"> delete</button>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
@livewireStyles
@livewireScripts

@endsection