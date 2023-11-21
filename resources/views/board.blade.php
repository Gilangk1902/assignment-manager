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
                    <button type="button" class="btn btn-primary btn-sm col-2" data-bs-toggle="modal" data-bs-target="#edit-task-title-modal" data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}">
                        Edit
                    </button>
                    {{-- manage task buttons --}}
                    <div class="col">
                        <div class="row">
                            <div class="col-3">
                                <form method="POST" action="/send-left/{{$board->id}}/{{$group->id}}/{{ $task->id }}">
                                    @csrf
                                    <button id="refresh-page" type="submit" class="btn btn-primary btn-sm"> < </button>
                                </form>
                            </div>
                            <div class="col-3">
                                <form method="POST" action="/delete-task/{{$board->id}}/{{$group->id}}/{{ $task->id }}">
                                    @csrf
                                    <button id="refresh-page" type="submit" class="btn btn-primary btn-sm"> X </button>
                                </form>
                            </div>
                            <div class="col-3">
                                <form method="POST" action="/send-right/{{$board->id}}/{{$group->id}}/{{ $task->id }}">
                                    @csrf
                                    <button id="refresh-page" type="submit" class="btn btn-primary btn-sm"> > </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach

            {{-- Add New Task --}}
            <div>
                <div class=""> 
                    <form action="/add-new-task/{{ $board->id }}/{{ $group->id }}" method="POST">
                        @csrf
                        <button id="refresh-page" type="submit" class="btn btn-primary btn-sm">+ Add New Task</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    @endforeach
    <div>
        {{-- Add New Group --}}
        <div class="card-header my-2"> 
            <form action="/add-new/{{ $board->id }}" method="POST">
                @csrf
                <button id="refresh-page" type="submit" class="btn btn-primary btn-sm">+ Add New Group</button>
            </form>
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

<script>
    $(document).ready(function(){
        $('#edit-board-title-modal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var board_id = button.data('board-id');
            var board_title = button.data('board-title');

            $(this).find('#board-input-title').val(board_title);
            $(this).find('#board-title-id').val(board_id);

            var updateBoardTitleUrl = "/update-board/" + board_id;
            $('#edit-board-form').attr('action', updateBoardTitleUrl);
        });

        $('#edit-group-title-modal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var group_id = button.data('group-id');
            var group_title = button.data('group-title');

            $(this).find('#group-input-title').val(group_title);
            $(this).find('#group-title-id').val(group_id);

            var updateGroupTitleUrl = "/update-group/" + group_id;
            $('#edit-group-form').attr('action', updateGroupTitleUrl);
        });

        $('#edit-task-title-modal').on('show.bs.modal', event => {
            var button = $(event.relatedTarget);
            var task_id = button.data('task-id');
            var task_title = button.data('task-title');

            $(this).find('#task-input-title').val(task_title);
            $(this).find('#task-title-id').val(task_id);

            var updateTaskTitleUrl = "/update-task/" + task_id;
            $('#edit-task-form').attr('action', updateTaskTitleUrl);
        });
    });
</script>

@endsection