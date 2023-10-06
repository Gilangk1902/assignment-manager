<?php

use App\Http\Controllers\BoardController;
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

Route::get('/board/{id}',
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

Route::get('/', 
    function(){
        $user = [
            "id" => "1",
            "username" => "Gilang"
        ];

        return view('home',
            [    
                "title" => "home",
                "id" => $user["id"],
                "username" => $user["username"]
            ]
        );
    }
);

Route::get('/profile/{id}',
    function($id){
        $users = [
            [
                "id" => "1",
                "username" => "Gilang"
            ]
        ];

        $fakin_user_dood = [];

        foreach($users as $user){
            if($user["id"] === $id){
                $fakin_user_dood = $user;
            }
        }

        return view('profile',
            [    
                "title" => "ur profile",
                "username" => $fakin_user_dood["username"]
            ]
        );
    }
);

Route::get('/about',
    function(){
        return view('about', 
            [
                "title" => "about",
                "name" => "Gilang Kurniawan",
                "email" => "gilangk1902@gmail.com",
                "image" => "gilang.png"
            ]
        );
    }
);