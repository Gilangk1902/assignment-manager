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

Route::get('/boards/{user_001}',
    [BoardController::class, 'FindUserBoards']
);

Route::get('/board/{id}',
    [BoardController::class, 'FindBoard']
);

Route::get('/', 
    function(){
        $user = [
            "id" => "user_001",
            "username" => "Gilang",
            "size" => "Big"
        ];

        return view('home',
            [    
                "title" => "home",
                "id" => $user["id"],
                "username" => $user["username"],
                "size" => $user["size"]
            ]
        );
    }
);

Route::get('/profile/{id}',
    function($id){
        $users = [
            [
                "id" => "user_001",
                "username" => "Gilang",
                "size" => "Big"
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
                "username" => $fakin_user_dood["username"],
                "size" => $fakin_user_dood["size"]
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