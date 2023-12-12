<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups';
    
    public static function FindGroups($board_id){
        return static::where('board_id', $board_id)->get();
    }

    protected $fillable = [
        'board_id',  
        'title',
        'slug',
        'position'
    ];

    public function board(){
        return $this->belongsTo(Board::class);
    }

    public function tasks(){
        return $this->hasMany(Task::class)->orderBy('position');
    }
}
