<?php

namespace App\Http\Controllers;

use App\Models\Like;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Likes extends Controller
{
    public function store($id){
        $this->delete($id);

        $like=new Like();
        $like->post=$id;
        $like->user=Auth::id();
        $like->save();
        return redirect()->back();
    }

    public function delete($id){
        $like=new Like();
        $like->where('post', '=', $id)->where('user', '=', Auth::id())->delete();
        return redirect()->back();
    }
}
