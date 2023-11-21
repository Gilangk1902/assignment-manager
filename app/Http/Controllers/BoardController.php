<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;

class BoardController extends Controller
{
    public function index(){
        return view('/', Board::all());
    }

    public function Show(Board $board)
    {
        return view('/board',
            [
                "title" => "a board",
                "board" => $board
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

    public function UpdateBoardTitle(Request $request, $board_id){
        $board = Board::find($board_id);

        $board->title = $request->input('board-input-title');

        $board->save();

        return redirect()->back();
    }
}
