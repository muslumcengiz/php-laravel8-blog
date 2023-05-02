<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    use HasFactory;

    function getUser(){
        return $this->hasOne('App\Models\User', 'id', 'user');
    }

    function getComments(){
        return $this->hasMany('App\Models\Comment', 'post', 'id')->orderBy('created_at', 'DESC');
    }

    function getLikes(){
        return $this->hasMany('App\Models\Like', 'post', 'id');
    }

    function isILike(){
        return $this->hasOne('App\Models\Like', 'post', 'id')->where('user', '=', Auth::id());
    }
}
