<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    function getUser(){
        return $this->hasOne('App\Models\User', 'id', 'user');
    }

    function getPost(){
        return $this->hasOne('App\Models\Post', 'id', 'post');
    }
}
