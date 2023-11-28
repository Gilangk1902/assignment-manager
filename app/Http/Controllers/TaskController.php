<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Controllers\GroupController;
use App\Models\Group;

class TaskController extends Controller
{
    private const LEFT = -1;
    private const RIGHT = 1;
    public function SendRight($board_id, $group_id, $task_id){
        $group_controller = new GroupController();

        $direction = $this->Direction($board_id, $group_id, self::RIGHT);
        $new_group_id = $group_controller->getGroupByIndex($board_id, $direction);
        
        $this->InsertTask($task_id, $new_group_id);
        $this->DeleteTask($group_id, $task_id);

    }

    public function SendLeft($board_id, $group_id,$task_id){
        $group_controller = new GroupController();
        
        $direction = $this->Direction($board_id, $group_id, self::LEFT);
        $new_group_id = $group_controller->getGroupByIndex($board_id, $direction);
        $this->InsertTask($task_id, $new_group_id);
        $this->DeleteTask($group_id, $task_id);
        
    }
    public function Direction($board_id, $group_id, $direction){
        $group_controller = new GroupController();
        $index_of_current_group = $group_controller->getIndexOfGroup($board_id, $group_id);
        
        if($index_of_current_group == 0 && $direction == self::LEFT){
            return $index_of_current_group;
        }
        else if($index_of_current_group == count($group_controller->getGroups($board_id))-1 && $direction == self::RIGHT){
            return $index_of_current_group;
        }

        $new_index = $index_of_current_group + $direction;
        return $new_index;
    }

    public function UpdateTaskTitle(Request $request, $task_id){
        $task = Task::find($task_id);
        $task->title = $request->input('task-input-title');
        $task->save();

        return redirect()->back();
    }

    public function AddNewTask($board_id, $group_id){
        Task::create(
            [
                "title" => "new task",
                "slug" => fake()->slug(),
                "group_id" => $group_id
            ]
        );

        return back();
    }

    public function InsertTask($task_id, $group_id){
        $new_task = Task::find($task_id);
        
        Task::create(
            [
                "title" => $new_task->title,
                "slug" => fake()->slug(),
                "group_id" => $group_id
            ]
        );
    }

    public function Delete($board_id, $group_id, $task_id){
        $this->DeleteTask($group_id, $task_id);
        return back();
    }

    public function DeleteTask($group_id, $id){
        Task::where("id", $id)->where("group_id", $group_id)->delete();
    }

    public function getTaskGroupId(Task $task){
        return $task->group->id;
    }
}
