<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Board extends Model
{
    use HasFactory;

    protected $fillable = [ 'user_id', 'title', 'slug'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public static function FindUserBoards($user_id){
        return static::where('user_id', $user_id)->get();
    }
}
