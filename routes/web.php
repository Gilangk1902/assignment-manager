<?php

use App\Http\Controllers\BoardController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\TaskController;
use App\Http\Controllers\UserController;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use App\Models\Board;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/boards/{user_id}',
    [BoardController::class, 'FindUserBoards']
)->name('boards.boards');

Route::get('/board/{board:slug}',
    [BoardController::class, 'Show']
)->name('board.board');

Route::get('/make_new_board',
    function(){
        return view('make_new_board',
        [
            "title" => "make new board dood"
        ]
    );
    }
);


Route::post('/login', [UserController::class, 'Login'])->name('login.post');

Route::get('/login',[UserController::class, 'ViewLoginPage'])->name('form');

Route::get('/register', [UserController::class, 'ViewRegisterPage'])->name('form');

Route::get('/logout',  [UserController::class, 'Logout'])->name('logout');

Route::post('/register', [UserController::class, 'Register'])->name('register');

Route::post('/send-right/{board_id}/{group_id}/{task_id}', [TaskController::class,'SendRight'])->name('send-right');

Route::post('/send-left/{board_id}/{group_id}/{task_id}', [TaskController::class,'SendLeft'])->name('send-left');

Route::post('/group-send-right/{board_id}/{group_id}', [GroupController::class,'SendRight'])->name('send-right-group');

Route::post('/group-send-left/{board_id}/{group_id}', [GroupController::class,'SendLeft'])->name('send-left-group');


Route::post('/send-up/{board_id}/{group_id}/{task_id}', [TaskController::class,'SendUp'])->name('send-up');

Route::post('/send-down/{board_id}/{group_id}/{task_id}', [TaskController::class,'SendDown'])->name('send-down');

Route::post('/delete-task/{board_id}/{group_id}/{task_id}', [TaskController::class,'Delete'])->name('delete-task');

Route::post('/delete-group/{board_id}/{group_id}', [GroupController::class,'Delete'])->name('delete');

Route::post('/star-board/{board_id}', [BoardController::class, 'Star'])->name('star-board');

Route::post('/add-new-board', [BoardController::class, 'AddNewDefaultBoard'])->name('add-new-board');

Route::post('/add-new-board-with-title', [BoardController::class, 'AddNewBoardWithTitle'])->name('add-new-board-with-title');

Route::post('/add-new-group/{board_id}', [GroupController::class,'AddNew'])->name('add-new');

Route::post('/add-new-task/{board_id}/{group_id}', [TaskController::class,'AddNewTask'])->name('add-new-task');

Route::post('/update-board/{board_id}', [BoardController::class, 'UpdateBoardTitle'])->name('update-board-title');

Route::post('/update-group/{group_id}', [GroupController::class, 'UpdateGroupTitle'])->name('update-group-title');

Route::post('/update-task/{task_id}', [TaskController::class, 'UpdateTaskTitle'])->name('update-task-title');

Route::post('/move-to-group/{task_id}/{group_id}', [TaskController::class, 'SendToGroup'])->name('move-to-group');
//default user for testing
Route::get('/', 
    function(){
        $user = auth()->user();

        return view('home',
            [    
                "title" => "home",
                "user" => $user
            ]
        );
    }
);
