<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Comments extends Controller
{
    public function store(Request $request){
        $request->validate([
            'comment'=>['required', 'min:3', 'max:2000'],
            'postId'=>['integer'],
        ]);

        $comment=new Comment();

        $comment->post=$request->postId;
        $comment->content=$request->comment;
        $comment->user=Auth::id();
        $comment->save();

        return redirect()->back()->with('commentSuccess', true);
    }
}
