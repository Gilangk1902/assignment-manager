<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    public static function FindUserBoards($user_id){
        return static::where('user_id', $user_id)->get();
    }
}
