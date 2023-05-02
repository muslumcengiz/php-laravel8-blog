<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class Posts extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth', 'role:Admin']);
    }

    public function index(){
        $data=Post::orderBy('created_at', 'DESC')
            ->paginate(10);

        return view('admin.posts')->with('postsData', $data);
    }

    public function delete($id){
        Post::findOrFail($id)->delete();
        return redirect()->back();
    }

    public function edit($id){
        $post=Post::findOrFail($id);
        return view('admin.postedit')->with('post', $post);
    }

    public function update(Request $request, $id){

        $request->validate([
            'title'=>['required', 'min:3', 'max:200'],
            'content'=>['required', 'min:3', 'max:10000'],
            'image'=>['file', 'mimes:jpeg,jpg,gif,png','min:10','max:11000'],
            'publish_date'=>['regex:@^\d\d/\d\d/\d\d\d\d$@','nullable']
        ]);

        $post=Post::findOrFail($id);
        $post->title=$request->title;
        $post->content=$request->content;
        $post->slug=Str::slug($request->title);

        if($request->publish_date!='')
            $post->publish_date=Carbon::createFromFormat('d/m/Y', $request->publish_date)->toDate();

        if($request->hasFile('image')){
            $imageName=Str::slug($request->image->getClientOriginalName()).'_'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $post->image='uploads/'.$imageName;
        }

        $post->save();
        return redirect()->back()->with('updatesuccess', true);
    }
}
