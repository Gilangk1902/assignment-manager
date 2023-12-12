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
        $last_group = Group::where('board_id', $board_id)->orderBy('position', 'desc')->first();

        $position = $last_group ? $last_group->position + 1 : 0;

        // Create a new group with the determined position
        Group::create([
            'board_id' => $board_id,
            'title' => 'New Group',
            'slug' => fake()->slug(),
            'position' => $position,
            // Add other attributes as needed
        ]);

        return back();
    }

    public function UpdateGroupTitle(Request $request, $group_id){
        $group = Group::find($group_id);
        $group->title = $request->input('group-input-title');
        $group->save();

        return redirect()->back();
    }

    public function Delete($board_id, $group_id){
        $group = Group::findOrFail($group_id);

        $position = $group->position;

        $group->delete();

        Group::where('board_id', $board_id)
            ->where('position', '>', $position)
            ->decrement('position');

        return back();
    }

    public function getPositionOfGroup($board_id, $group_id){
        $group = Group::where('board_id', $board_id)
                ->where('id', $group_id)
                ->first();

        if ($group) {
            return $group->position;
        }

        return null;
    }

    public function getGroupByPosition($board_id, $position){
        $group = Group::where('board_id', $board_id)
        ->where('position', $position)
        ->first();

        return $group->id;
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
