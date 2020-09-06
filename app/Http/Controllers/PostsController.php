<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\posts\CreatePostRequest;
use App\Http\Requests\posts\UpdatePostRequest;
use Illuminate\Support\Facades\Storage;
use App\Post;
use App\Category;
use App\Tag;

class PostsController extends Controller
{


    public function __construct()
    {
        $this->middleware('VerifyCategoryCount')->only(['create','store']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('admin.posts.index')->with('posts',Post::where('confirmed','=',1)->orderBy('created_at','desc')->get());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.posts.create')->with('categories',Category::all())
                                            ->with('tags',Tag::all());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreatePostRequest $request)
    {
        $image=$request->image;
        $name=time().$image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
        $destination=public_path('/posts-images');
        $image->move($destination,$name);
        // $image=$request->image->store('posts');
        $post=Post::create([
            'title'=>$request->title,
            'image'=>'posts-images/'.$name,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
            'user_id'=>auth()->user()->id
        ]);
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        session()->flash('success','post created successfuly please go and confirm it');
        return redirect()->route('posts.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        return view('admin.posts.create')->with('post',$post)
                                            ->with('categories',Category::all())
                                            ->with('tags',Tag::all());
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,Post $post)
    {
        if($request->hasFile('image')){
            // $image=$request->image->store('posts');
            // Storage::delete($post->image);
            unlink($post->image);
            $image=$request->file('image');
            $name=time().$image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
            $destination=public_path('/posts-images');
            $image->move($destination,$name);
            $post->update([
                'title'=>$request->title,
                'image'=>'posts-images/'.$name,
                'content'=>$request->content,
                'category_id'=>$request->category_id,
            ]);
        }
        $post->update([
            'title'=>$request->title,
            'content'=>$request->content,
            'category_id'=>$request->category_id,
        ]);
        if($request->tags){
            $post->tags()->sync($request->tags);
        }
        session()->flash('success','post created successfuly');
        return redirect()->route('posts.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();
        if($post->trashed()){
            // Storage::delete($post->image);
            unlink($post->image);
            $post->forceDelete();
        }else{
            $post->delete();
        }
        session()->flash('success','post deleted successfuly');
        return back();
    }
    public function trashed()
    {
        $trashed=Post::onlyTrashed()->get();
        return view('admin.posts.index')->with('posts',$trashed)
                                        ->with('trashed',1);
    }
    public function restore($id)
    {
        $post=Post::onlyTrashed()->where('id',$id)->first();
        $post->restore();
        session()->flash('success','post restored successfuly');
        $trashed=Post::onlyTrashed()->get();
        return back();
    }

    public function confirmed()
    {
        $trashed=Post::where('confirmed','=',0)->get();
        return view('admin.posts.index')->with('posts',$trashed)
                                        ->with('confirmed',1);
    }

    public function confirm(Post $post)
    {
        $post->confirmed=1;
        $post->save();
        session()->flash('success','post confirmed successfuly');
        $trashed=Post::onlyTrashed()->get();
        return back();
    }
}
