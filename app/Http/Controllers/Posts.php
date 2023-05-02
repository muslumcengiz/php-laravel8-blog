<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class Posts extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        $data=Post::orderBy('created_at', 'DESC')
            ->whereNull('publish_date')
            ->orWhere('publish_date', '<=', date('Y-m-d H:i:s'))
            ->paginate(5);

        return view('posts.posts')->with('postsData', $data);
    }

    public function show($slug){
        $data=Post::where('slug', '=', $slug)->first() ?? abort('403', __('The record you requested was not found.'));

        return view('posts.show')->with('post', $data);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request){
        $request->validate([
            'title'=>['required', 'min:3', 'max:200'],
            'content'=>['required', 'min:3', 'max:10000'],
            'image'=>['file', 'mimes:jpeg,jpg,gif,png','min:10','max:11000'],
            'publish_date'=>['regex:@^\d\d/\d\d/\d\d\d\d$@','nullable']
        ]);

        $post=new Post();
        $post->title=$request->title;
        $post->content=$request->content;
        $post->slug=Str::slug($request->title);
        $post->user=Auth::id();

        if($request->publish_date!='')
            $post->publish_date=Carbon::createFromFormat('d/m/Y', $request->publish_date)->toDate();

        if($request->hasFile('image')){
            $imageName=Str::slug($request->image->getClientOriginalName()).'_'.time().'.'.$request->image->getClientOriginalExtension();
            $request->image->move(public_path('uploads'), $imageName);
            $post->image='uploads/'.$imageName;
        }

        $post->save();

        return view('posts.success');
    }
}
