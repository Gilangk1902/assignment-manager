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

    protected $fillable = [ 
        'user_id', 
        'title', 
        'slug'
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function groups(){
        return $this->hasMany(Group::class);
    }

    public function categories(){
        
    }
}

