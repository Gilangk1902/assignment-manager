<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $table = 'tasks';
    protected $fillable = [
        'group_id',  
        'title',
        'slug',
        'position'
    ];

    public function group(){
        return $this->belongsTo(Group::class);
    }
}
