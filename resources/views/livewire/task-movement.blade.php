
    {{-- tasks --}}
    <div class="card-header my-2 mx-0 px-0">
        <div class="row ">
            <p class="col m-2 mx-3">{{ $task->position }} {{$task->title}}</p>
            {{-- edit button --}}
            <button type="button" class="btn btn-primary btn-sm col-2" data-bs-toggle="modal" data-bs-target="#edit-task-title-modal" 
                data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}">
                Edit
            </button>
            {{-- manage task buttons --}}
            <div class="col">
                <div class="row">
                    <div class="col">
                        <button type="button" class="btn btn-primary btn" data-bs-toggle="modal" data-bs-target="#move-task-modal" 
                            data-task-id="{{ $task->id }}" data-task-title="{{ $task->title }}" data-board-id="{{ $board->id }}" data-group-id="{{ $group->id }}"
                            wire:click="clickTask({{ $task->id }})">
                            Move
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
