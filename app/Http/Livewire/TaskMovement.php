<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Task;

class TaskMovement extends Component
{
    public $boardId;
    public $groupId;

    public $task;
    public $group;
    public $board;
    public function mount($boardId, $groupId, $board, $group, $task)
    {
        $this->boardId = $boardId;
        $this->groupId = $groupId;
        $this->board = $board;
        $this->group = $group;
        $this->task = $task;
    }

    public function clickTask($taskId)
    {
        $this->emit('taskClicked', $taskId);
    }
    public function render()
    {
        // Fetch tasks and groups as needed
        $tasks = Task::where('group_id', $this->groupId)->orderBy('position')->get();

        return view('livewire.task-movement', ['tasks' => $tasks]);
    }

    private const LEFT = -1;
    private const RIGHT = 1;
    private const UP = -1;
    private const DOWN = 1;

    public function SendUp($board_id, $group_id, $task_id) {
        $current_task_position = $this->getTaskPosition($group_id, $task_id);
    
        if ($current_task_position !== null && $current_task_position > 0) {
            $new_task_position = $current_task_position + self::UP;
            
            // Get the task to be moved
            $task = Task::where('group_id', $group_id)
                ->where('id', $task_id)
                ->first();
    
            if ($task) {
                $this->SwitchPosition($new_task_position, $current_task_position, $group_id);
                $task->update(['position' => $new_task_position]);
            }
        }
    
        
    }
    
    public function SendDown($board_id, $group_id, $task_id) {
        $current_task_position = $this->getTaskPosition($group_id, $task_id);
    
        //create validation if task position is already in last 
        if($current_task_position  < $this->getMaxTaskPosition($group_id)){
            $new_task_position = $current_task_position + self::DOWN;
    
            $task = Task::where('group_id', $group_id)
                ->where('id', $task_id)
                ->first();
        
            if ($task) {
                $this->SwitchPosition($new_task_position, $current_task_position, $group_id);
                $task->update(['position' => $new_task_position]);
            }
        }
    
        return back();
    }

    private function SwitchPosition($target_position, $current_position, $group_id){
        $task = Task::where('group_id', $group_id)->where('position', $target_position)
                ->first();
        if($task){
            $task->update(['position' => $current_position]);
        }
    }

    public function SendRight($board_id, $group_id, $task_id){
        $group_controller = new GroupController();

        $new_group_position = $this->NewGroupPosition($board_id, $group_id, self::RIGHT);
        $new_group_id = $group_controller->getGroupByPosition($board_id, $new_group_position);
        
        $this->InsertTask($task_id, $new_group_id);
        $this->DeleteTask($group_id, $task_id);
        $this->ReorderTasks($group_id);
    }

    public function SendLeft($board_id, $group_id,$task_id){
        $group_controller = new GroupController();
        
        $new_group_position = $this->NewGroupPosition($board_id, $group_id, self::LEFT);
        $new_group_id = $group_controller->getGroupByPosition($board_id, $new_group_position);

        $this->InsertTask($task_id, $new_group_id);
        $this->DeleteTask($group_id, $task_id);
        $this->ReorderTasks($group_id);
    }

    public function ReorderTasks($group_id) {
        $tasks = Task::where('group_id', $group_id)->orderBy('position')->get();
    
        $position = 0;
        foreach ($tasks as $task) {
            $task->update(['position' => $position]);
            $position++;
        }
    }

    public function NewGroupPosition($board_id, $group_id, $direction){
        $group_controller = new GroupController();
        $position_of_current_group = $group_controller->getPositionOfGroup($board_id, $group_id);
        
        if($position_of_current_group == 0 && $direction == self::LEFT){
            return $position_of_current_group;
        }
        else if($position_of_current_group == count($group_controller->getGroups($board_id))-1 && $direction == self::RIGHT){
            return $position_of_current_group;
        }

        $new_position = $position_of_current_group + $direction;
        return $new_position;
    }

    public function UpdateTaskTitle(Request $request, $task_id){
        $task = Task::find($task_id);
        $task->title = $request->input('task-input-title');
        $task->save();

        return redirect()->back();
    }

    public function AddNewTask($board_id, $group_id){
        $last_task = Task::where('group_id', $group_id)->orderBy('position', 'desc')->first();
        $position = $last_task ? $last_task->position + 1 : 0;
        
        Task::create(
            [
                "title" => "new task",
                "slug" => fake()->slug(),
                "group_id" => $group_id,
                "position" => $position
            ]
        );

        return back();
    }

    public function getTaskPosition($group_id, $task_id){
        $task = Task::where('group_id', $group_id)
        ->where('id', $task_id)
        ->first();

        if ($task) {
            return $task->position;
        } else {
            return null;
        }
    }

    public function InsertTask($task_id, $group_id){
        $new_task = Task::find($task_id);
        $last_task = Task::where('group_id', $group_id)->orderBy('position', 'desc')->first();
        $position = $last_task ? $last_task->position + 1 : 0;
        
        Task::create(
            [
                "title" => $new_task->title,
                "slug" => fake()->slug(), 
                "group_id" => $group_id,
                "position" =>$position
            ]
        );
    }

    public function Delete($board_id, $group_id, $task_id){
        $task = Task::findOrFail($task_id);
        $position = $task->position;

        $task->delete();

        Task::where('group_id', $group_id)
            ->where('position', '>', $position)
            ->decrement('position');

        return back();
    }

    public function DeleteTask($group_id, $id){
        Task::where("id", $id)->where("group_id", $group_id)->delete();
    }

    private function getMaxTaskPosition($group_id) {
        return Task::where('group_id', $group_id)->max('position');
    }
}
