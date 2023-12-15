<?php

namespace App\Http\Controllers;

use App\Models\Board;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BoardController extends Controller
{
    public function index(){
        return view('/', Board::all());
    }

    public function Show(Board $board)
    {
        $board = Board::with(['groups' => function ($query) {
                $query->orderBy('position');
            }, 
            'groups.tasks' => function ($query) {
                $query->orderBy('position');
            }])->findOrFail($board->id);

        return view('board', compact('board'));
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

    public function AddNewDefaultBoard(){
        Board::Create(
            [
                "user_id" => Auth::id(),
                "title" => "New Board",
                "description" => fake()->sentence(),
                "slug"  => fake()->slug()
            ]
        );
    }

    public function AddNewBoard($title){
        Board::Create(
            [
                "user_id" => Auth::id(),
                "title" => $title,
                "description" => fake()->sentence(),
                "slug"  => fake()->slug()
            ]
        );
        return redirect()->route('boards.show', ['user_id' => Auth::id()]);
    }

    public function UpdateBoardTitle(Request $request, $board_id){
        $board = Board::find($board_id);

        $board->title = $request->input('board-input-title');
        $board->description = $request->input('board-input-description');

        $board->save();

        return redirect()->back();
    }
}
