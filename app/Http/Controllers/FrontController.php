<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\posts\CreatePostRequest;
use App\Http\Requests\posts\UpdatePostRequest;
use App\Http\Requests\users\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;
use App\Category;
use App\Tag;

class FrontController extends Controller
{
    // Display the welcome page
    public function index()
    {
        return view('welcome')->with('user',auth()->user())
                                ->with('posts',Post::orderBy('created_at','desc')->paginate(12))
                                ->with('categories',Category::all())
                                ->with('tags',Tag::all());
    }

    // show evry single post
    public function show(Post $post)
    {
        return view('blog.single')->with('categories',Category::all())
                                    ->with('post',$post);
    }

    // show the posts that belongs to a category
    public function category(Category $category)
    {
        return view('blog.category')->with('category',$category)
                                    ->with('categories',Category::all())
                                    ->with('posts',Post::where('category_id',$category->id)->paginate(12));
    }

    // show the posts that belongs to a tag
    public function tag(Tag $tag)
    {
        return view('blog.tag')->with('tag',$tag)
                                    ->with('categories',Category::all())
                                    ->with('posts',$tag->posts()->paginate(12));
    }

    // show the profile of the user with his posts
    public function profile(User $user)
    {
        return view('blog.profile')->with('categories',Category::all())
                                    ->with('user',$user)
                                    ->with('posts',Post::orderBy('created_at','desc')->where('user_id',$user->id)->paginate(12));
    }

    // here the user can edit his profile
    public function editProfile(User $user)
    {
        return view('blog.edit')->with('categories',Category::all())
                                ->with('user',$user);
    }

    // update profile
    public function updateProfile(UpdateUserRequest $request,User $user)
    {
        if($request->hasFile('avatar')){
            if($user->avatar){
                $avatar=$request->avatar->store('users');
                Storage::delete($user->avatar);
                $user->update([
                    'avatar'=>$avatar
                ]);
            }else{
                $avatar=$request->avatar->store('users');
                $user->update([
                    'avatar'=>$avatar
                ]);
            }
        }
        if($request->name){
            $user->name=$request->name;
        }
        if($request->facebook){
            $user->facebook=$request->facebook;
        }
        if($request->instagram){
            $user->instagram=$request->instagram;
        }
        if($request->twitter){
            $user->twitter=$request->twitter;
        }
        if($request->about){
            $user->about=$request->about;
        }
        $user->save();
        return redirect()->route('profile',$user->id);
    }

    // page where the users can create posts
    public function createPost()
    {
        return view('blog.create')->with('categories',Category::all())
                                    ->with('tags',Tag::all());
    }

    // store the posts
    public function store_post(CreatePostRequest $request)
    {
        $image=$request->image->store('posts');
        $post=Post::create([
            'title'=>$request->title,
            'image'=>$image,
            'category_id'=>$request->category_id,
            'user_id'=>auth()->user()->id
        ]);
        if($request->content){
            $post->content=$request->content;
            $post->save();
        }
        if($request->tags){
            $post->tags()->attach($request->tags);
        }
        return redirect()->route('profile',auth()->user()->id);
    }

    // page where the users can edit posts
    public function editPost(Post $post)
    {
        return view('blog.create')->with('post',$post)
                                    ->with('categories',Category::all())
                                    ->with('tags',Tag::all());
    }

    // update posts
    public function update_post(UpdatePostRequest $request,Post $post)
    {
        if($request->hasFile('image')){
            $image=$request->image->store('posts');
            Storage::delete($post->image);
            $post->update([
                'title'=>$request->title,
                'image'=>$image,
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
        return redirect()->route('single-post',$post->id);
    }

    // search for posts
    public function search(Request $request){
        return view('blog.result')->with('posts',Post::where('title','like','%'.request('query').'%')->paginate(12))
                        ->with('categories',Category::all())
                        ->with('query',request('query'));
    }
}
