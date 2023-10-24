<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Task;
use App\Http\Controllers\GroupController;
use App\Models\Group;

class TaskController extends Controller
{
    private function getGroupByIndex($board_id, $index){
        //this method is for getting the group id by index of its array counterpart
        $groupController = new GroupController();
        $groups = $groupController->getGroups($board_id);

        if ($index >= 0 && $index < count($groups)) {
            return $groups[$index]->id;
        } else {
            return null;
        }
    }

    public function SendRight($board_id, $group_id,Task $task){
        $new_group_id = $this->getGroupByIndex($board_id, 1);
        $this->InsertTask($task, $new_group_id);
        $this->DeleteTask($group_id, $task->id);

        return back();
    }

    public function SendLeft($board_id, $group_id,Task $task){
        $new_group_id = $this->getGroupByIndex($board_id, 0);
        $this->InsertTask($task, $new_group_id);
        $this->DeleteTask($group_id, $task->id);
        
        return back();
    }

    public function InsertTask(Task $task, $group_id){
        Task::create(
            [
                "title" => $task->title,
                "slug" => fake()->slug(),
                "group_id" => $group_id
            ]
        );
    }

    public function DeleteTask($group_id, $id){
        Task::where("id", $id)->where("group_id", $group_id)->delete();
    }

    public function getTaskGroupId(Task $task){
        return $task->group->id;
    }
}
