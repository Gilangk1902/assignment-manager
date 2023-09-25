<?php

namespace App\Models;

class Board
{
    private static $boards = [
        [
            "id" => "001",
            "user_id"  => "user_001",
            "name" => "Assignment Manager Project",
            "description" => "mother fucker im so faking retarded what the fuck brah."
        ],
        [
            "id" => "002",
            "user_id"  => "user_001",
            "name" => "Home Tasks",
            "description" => "hey what the fack dood, what yo looking at brah."
        ]
    ];

    public static function All(){
        return collect(self::$boards);
    }

    public static function Find($id){
        return static::All()->firstWhere('id', $id);
    }

    public static function FindUserBoards($user_id){
        return static::All()->where('user_id', $user_id);
    }
}
