@extends('layouts.main')

@section('container')
<script src="{{ asset('js/board.js') }}"></script>
<link rel="stylesheet" href="{{ asset('css/modal.css') }}">
<link rel="stylesheet" href="{{ asset('css/style.css') }}">

<h1>
    {{ $board->title }}

        @if($board->starred)
        <button type="button" class="btn btn-link" id="unstar-button"
        data-board-id="{{ $board->id }}">
            <i class="bi bi-star-fill"></i>
        </button>   
        @else
        <button type="button" class="btn btn-link" id="star-button"
        data-board-id="{{ $board->id }}">
            <i class="bi bi-star"></i>
        </button>   
        @endif
</h1>
<h5>
    {{ $board->description }}
</h4>
<div class="mt-2 mb-4">
    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edit-board-title-modal" 
        data-board-id="{{ $board->id }}" data-board-title="{{ $board->title }}" data-board-description="{{ $board->description }}">
    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
        <path d="M11.293 0.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 0-1.414l10-10a1 1 0 0 1 1.414 0zM12 2l1.297 1.297-1 1L11 3l1-1zM1 8l1.297 1.297-1 1L0 9l1-1zm10-6l1.297 1.297-1 1L10 3l1-1zM2.414 12l1.297 1.297-1 1L1.414 13l1-1z"/>
    </svg>
</button>
</div>

<div class="slider-container">
    <div class="slider">
        {{-- groups --}}
        @foreach($board->groups as $group)
        <div class="card me-2 group-card" style="width: 30rem;">
            <div class="row">
                <p class="card-title mt-3 ml-4 col fs-4">{{$group->title}}</p>
                <div class="mt-3 col-1 mr-2">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#edit-group-title-modal" data-group-id="{{ $group->id }}" data-group-title="{{ $group->title }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                            <path d="M11.293 0.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 0-1.414l10-10a1 1 0 0 1 1.414 0zM12 2l1.297 1.297-1 1L11 3l1-1zM1 8l1.297 1.297-1 1L0 9l1-1zm10-6l1.297 1.297-1 1L10 3l1-1zM2.414 12l1.297 1.297-1 1L1.414 13l1-1z"/>
                        </svg>
                    </button>
                </div>
                
                <div class="mt-3 mr-4 col-2">
                    <button type="button" class="btn btn-outline-primary" data-bs-toggle="modal" data-bs-target="#move-group-modal"
                        data-board-id="{{ $board->id }}" data-group-title="{{ $group->title }}" data-group-id="{{ $group->id }}">
                        Move </button>
                </div>
            </div>
            <div class="card-body">
                {{-- tasks --}}
                @foreach($group->tasks as $task)
                <div class="card-header my-2 mx-0 px-0">
                    <div class="row ">
                        <p class="col m-2 mx-3">{{ $task->position }} {{$task->title}}</p>
                        {{-- edit button --}}
                        <button type="button" class="btn btn-outline-primary btn-sm col-2 p-0" data-bs-toggle="modal" data-bs-target="#edit-task-title-modal" 
                            data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                <path d="M11.293 0.293a1 1 0 0 1 1.414 0l2 2a1 1 0 0 1 0 1.414l-10 10a1 1 0 0 1-1.414 0l-2-2a1 1 0 0 1 0-1.414l10-10a1 1 0 0 1 1.414 0zM12 2l1.297 1.297-1 1L11 3l1-1zM1 8l1.297 1.297-1 1L0 9l1-1zm10-6l1.297 1.297-1 1L10 3l1-1zM2.414 12l1.297 1.297-1 1L1.414 13l1-1z"/>
                            </svg>
                        </button>
                        {{-- manage task buttons --}}
                        <div class="col">
                            <div class="row">
                                <div class="col">
                                    <button type="button" class="btn btn-outline-primary btn" data-bs-toggle="modal" data-bs-target="#move-task-modal" 
                                        data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}" data-board-id="{{ $board->id }}" data-group-id="{{ $group->id }}">
                                        Move
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
    
                {{-- Add New Task --}}
                <div>
                    <div class=""> 
                        <button id="add-new-task-button" type="submit" class="add-new-task-button btn btn-outline-primary btn-sm"
                        data-board-id="{{ $board->id }}" data-group-id="{{ $group->id }}">+ Add New Task</button>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        <div>
            
        </div>
    </div>
    <button class="slider-button prev">&lt;</button>
    <button class="slider-button next">&gt;</button>

    {{-- Add New Group --}}
    <div class="card-header my-2"> 
        @csrf
        <button id="add-new-group-button" type="submit" class="add-new-group-button btn btn-outline-primary btn-sm"
            data-board-id="{{ $board->id }}">+ Add New Group</button>
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
                        <label for="board-input-description">Description</label>
                        <input type="text" class="form-control" id="board-input-description" name="board-input-description">
                    </div>
                    <button type="submit" class="btn btn-primary" id="update-board-button" action="">Submit</button>
                </form>
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
                <form id="move-task-form">
                    @csrf
                    <input type="hidden" name="board_id" id="move-board-id">
                    <input type="hidden" name="group_id" id="move-group-id">
                    <input type="hidden" name="task_id" id="move-task-id">

                    <div class="keyboard-buttons">
                        <div class="keyboard-row">
                            <div class="keyboard-button">
                                <button id="up-button" type="button" class="up-button btn btn-primary btn-sm">
                                    &#x2191; <!-- Unicode arrow up character -->
                                </button>
                            </div>
                        </div>
                        <div class="keyboard-row">
                            <div class="keyboard-button">
                                <button id="left-button" type="button" class="left-button btn btn-primary btn-sm">
                                    &#x2190; <!-- Unicode arrow left character -->
                                </button>
                                </div>
                            <div class="keyboard-button">
                                <button id="down-button" type="button" class="down-button btn btn-primary btn-sm">
                                    &#x2193; <!-- Unicode arrow down character -->
                                </button>
                            </div>
                            <div class="keyboard-button">
                                <button id="right-button" type="button" class="right-button btn btn-primary btn-sm">
                                    &#x2192; <!-- Unicode arrow right character -->
                                </button>
                            </div>
                        </div>                  
                    </div>

                    <div class="col mt-4">
                        <label for="move-to" class="form-label">Move to another group</label>
                        <select class="form-select" name="groups" id="move-to">
                            <option value="" selected>Choose</option>
                            @foreach ($board->groups as $group)
                                <option value="{{ $group->id }}">{{ $group->title }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col d-flex justify-content-end mt-2">
                        <div class="ms-2">
                            <button id="delete-button" type="button" class="delete-button btn btn-primary btn-sm btn-danger">
                                Delete
                            </button>
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Move group Modal -->
<div class="modal fade move-group-modal custom" id="move-group-modal" tabindex="-1" role="dialog" aria-labelledby="move-group-modal-label" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="move-group-title-modal-label">Move Group</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="move-task-form">
                    @csrf
                    <input type="hidden" name="board_id" id="move-board-id-group">
                    <input type="hidden" name="group_id" id="move-group-id-group">

                    <div class="keyboard-buttons">
                        <div class="keyboard-row">
                            <div class="keyboard-button">
                                <button id="left-button-group" type="button" class="left-button-group btn btn-primary btn-sm">
                                    &#x2190; <!-- Unicode arrow left character -->
                                </button>
                                </div>
                            <div class="keyboard-button">
                                <button id="right-button-group" type="button" class="right-button-group btn btn-primary btn-sm">
                                    &#x2192; <!-- Unicode arrow right character -->
                                </button>
                            </div>
                        </div>                  
                    </div>

                    <div class="col d-flex justify-content-end mt-2">
                        <div class="ms-2">
                            <button id="delete-button" type="button" class="delete-button btn btn-primary btn-sm btn-danger">
                                Delete
                            </button>
                        </div>
                    </div>  
                </form>
            </div>
        </div>
    </div>
</div>

    <script>
    
</script>

@endsection