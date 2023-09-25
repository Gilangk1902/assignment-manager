<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function GetAll(){
        return view('/', Board::All());
    }

    public function FindBoard($id){
        $current_board = Board::Find($id);
        return view('/board',
            [
                "title" => $current_board["name"],
                "current_board" => $current_board
            ]
        );
    }

    public function FindUserBoards($user_id){
        $user_boards = Board::FindUserBoards($user_id);
        return view('/boards', 
            [
                "title" => "Your Boards",
                'user_boards' => $user_boards
            ]
        );
    }
}
