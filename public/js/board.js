$(document).on('click', '.right-button', function(event) {
    event.preventDefault();

    var right_button = $(this);
    var board_id = right_button.data('board-id');
    var task_id = right_button.data('task-id');
    var group_id = right_button.data('group-id');

    $.ajax(
        {
            url: "/send-right/" + board_id + "/" + group_id + "/" + task_id,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle success response if needed
                console.log("executed");
                location.reload();
            },
            error: function(error) {
                // Handle error if needed
                console.error("error");
            }
        }
    );
});
$(document).on('click', '.left-button', function(event) {
    event.preventDefault();

    var left_button = $(this);
    var board_id = left_button.data('board-id');
    var task_id = left_button.data('task-id');
    var group_id = left_button.data('group-id');

    $.ajax(
        {
            url: "/send-left/" + board_id + "/" + group_id + "/" + task_id,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle success response if needed
                console.log("executed");
                location.reload();
            },
            error: function(error) {
                // Handle error if needed
                console.error("error");
            }
        }
    );
});
$(document).on('click', '.delete-button', function(event) {
    event.preventDefault();

    var delete_button = $(this);
    var board_id = delete_button.data('board-id');
    var task_id = delete_button.data('task-id');
    var group_id = delete_button.data('group-id');

    $.ajax(
        {
            url: "/delete-task/" + board_id + "/" + group_id + "/" + task_id,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle success response if needed
                console.log("executed");
                location.reload();
            },
            error: function(error) {
                // Handle error if needed
                console.error("error");
            }
        }
    );
});
$(document).on('click', '.add-new-group-button', function(event) {
    event.preventDefault();

    var board_id = $(this).data('board-id');

    $.ajax(
        {
            url: "/add-new-group/" + board_id,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle success response if needed
                console.log("executed");
                location.reload();
            },
            error: function(error) {
                // Handle error if needed
                console.error("error");
            }
        }
    );
});
$(document).on('click', '.add-new-task-button', function(event) {
    event.preventDefault();

    var board_id = $(this).data('board-id');
    var group_id = $(this).data('group-id');

    $.ajax(
        {
            url: "/add-new-task/" + board_id + "/" + group_id,
            type: "POST",
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function(response) {
                // Handle success response if needed
                console.log("executed");
                location.reload();
            },
            error: function(error) {
                // Handle error if needed
                console.error("error");
            }
        }
    );
});

//Modal Scripts
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