$(document).ready(function(){
    $(document).on('change', '#move-to', function () {
        console.log("move-to clicked");

        var new_group_id = $(this).val();
        var task_id = $('#move-task-id').val();

        // Send an Ajax request to update the task
        $.ajax({
            type: 'POST',
            url: '/move-to-group/' + task_id + '/' + new_group_id,
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            success: function (data) {
                // Update the UI or perform additional actions
                console.log('Task moved successfully');
                location.reload();
            },
            error: function (error) {
                console.error('Error moving task:', error);
            }
        });
    });

    $(document).on('click', '.right-button-group', function(event) {
        event.preventDefault();
    
        console.log("right button clicked");  // Add this line
    
        var board_id = $('#move-board-id-group').val();
        var group_id = $('#move-group-id-group').val();
    
        $.ajax(
            {
                url: "/group-send-right/" + board_id + "/" + group_id,
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

    $(document).on('click', '.left-button-group', function(event) {
        event.preventDefault();
    
        console.log("right button clicked");  // Add this line
    
        var board_id = $('#move-board-id-group').val();
        var group_id = $('#move-group-id-group').val();
    
        $.ajax(
            {
                url: "/group-send-left/" + board_id + "/" + group_id,
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

    $(document).on('click', '.right-button', function(event) {
        event.preventDefault();
    
        console.log("right button clicked");  // Add this line
    
        var board_id = $('#move-board-id').val();
        var task_id = $('#move-task-id').val();
        var group_id = $('#move-group-id').val();
    
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
    
        console.log("left button clicked");  // Add this line
    
        var board_id = $('#move-board-id').val();
        var task_id = $('#move-task-id').val();
        var group_id = $('#move-group-id').val();
    
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
    $(document).on('click', '.up-button', function(event) {
        event.preventDefault();
    
        console.log("Up button clicked");  // Add this line
    
        var board_id = $('#move-board-id').val();
        var task_id = $('#move-task-id').val();
        var group_id = $('#move-group-id').val();
    
        $.ajax(
            {
                url: "/send-up/" + board_id + "/" + group_id + "/" + task_id,
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
    $(document).on('click', '.down-button', function(event) {
        event.preventDefault();
    
        console.log("down button clicked");  // Add this line
    
        var board_id = $('#move-board-id').val();
        var task_id = $('#move-task-id').val();
        var group_id = $('#move-group-id').val();
    
        $.ajax(
            {
                url: "/send-down/" + board_id + "/" + group_id + "/" + task_id,
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
    
        var board_id = $('#move-board-id').val();
        var task_id = $('#move-task-id').val();
        var group_id = $('#move-group-id').val();
    
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
});


//Modal Scripts
$(document).ready(function(){
    $('#edit-board-title-modal').on('show.bs.modal', event => {
        var button = $(event.relatedTarget);
        var board_id = button.data('board-id');
        var board_title = button.data('board-title');
        var board_description = button.data('board-description');

        $(this).find('#board-input-title').val(board_title);
        $(this).find('#board-title-id').val(board_id);
        $(this).find('#board-input-description').val(board_description);

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

    $('#move-task-modal').on('show.bs.modal', event=>{
        var button = $(event.relatedTarget);
        var board_id = button.data('board-id');
        var group_id = button.data('group-id');
        var task_id = button.data('task-id');
        var task_title = button.data('task-title')

        var newTitle = "Move " + task_title;

        $('#move-task-modal').find('#edit-task-title-modal-label').text(newTitle);

        $('#move-task-modal').find('#task-title-id').val(task_id);
        $('#move-task-modal').find('#move-task-id').val(task_id);
        $('#move-task-modal').find('#move-board-id').val(board_id);
        $('#move-task-modal').find('#move-group-id').val(group_id);
    });

    $('#move-group-modal').on('show.bs.modal',  event =>{
        var button = $(event.relatedTarget);
        var board_id = button.data('board-id');
        var group_id = button.data('group-id');
        var group_title = button.data('group-title');

        var new_title = "Move " + group_title;

        $('#move-group-modal').find('#move-group-title-modal-label').text(new_title);

        $('#move-group-modal').find('#move-board-id-group').val(board_id);
        $('#move-group-modal').find('#move-group-id-group').val(group_id);
    });
});