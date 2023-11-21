<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function index(){
        
    }

    public function AddNew($board_id){
        Group::Create(
            [
                "board_id" => $board_id,
                "title" => "New Group",
                "slug"  => fake()->slug()
            ]
        );

        return back();
    }

    public function UpdateGroupTitle(Request $request, $group_id){
        $group = Group::find($group_id);
        $group->title = $request->input('group-input-title');
        $group->save();

        return redirect()->back();
    }

    public function Delete($board_id, $group_id){
        Group::where("id", $group_id)->delete();
        return back();
    }

    public function getIndexOfGroup($board_id, $group_id){
        $groups = $this->getGroups($board_id);

        for($i = 0; $i < count($groups); $i++){
            if($groups[$i]->id == $group_id){
                return $i;
            }
        }
        return null;
    }

    public function getGroupByIndex($board_id, $index){
        $groups = $this->getGroups($board_id);

        if ($index >= 0 && $index < count($groups)) {
            return $groups[$index]->id;
        } else {
            return null;
        }
    }

    public function getGroups($board_id){
        return Group::where("board_id", $board_id)->get();
    }

    public function Show(Board $board){
        return view(
            '/board',
            [
                "board" => $board
            ]
        );
    }
}
