<?php

use App\Http\Controllers\BoardController;
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
);

Route::get('/board/{board:slug}',
    [BoardController::class, 'Show']
);

Route::get('/make_new_board',
    function(){
        return view('make_new_board',
        [
            "title" => "make new board dood"
        ]
    );
    }
);

//default user for testing
Route::get('/', 
    function(){
        $user = User::FindUser(1);

        return view('home',
            [    
                "title" => "home",
                "user" => $user
            ]
        );
    }
);