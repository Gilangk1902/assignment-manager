<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends Controller
{
    public function index(){
        
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
