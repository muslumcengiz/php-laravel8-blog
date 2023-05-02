<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Comments extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    public function index(){
        $data=Comment::orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin.comments')->with('commentsData', $data);
    }

    public function delete($id){
        Comment::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function edit($id){
        $post=Comment::findOrFail($id);
        return view('admin.postedit')->with('post', $post);
    }

    public function update(Request $request, $id){

        //
    }
}
