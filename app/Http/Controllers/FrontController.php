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
                                ->with('posts',Post::where('confirmed','=',1)->orderBy('created_at','desc')->get())
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
                                    ->with('posts',Post::where('confirmed','=',1)->where('category_id',$category->id)->get());
    }

    // show the posts that belongs to a tag
    public function tag(Tag $tag)
    {
        return view('blog.tag')->with('tag',$tag)
                                    ->with('categories',Category::all())
                                    ->with('posts',$tag->posts()->where('confirmed','=',1)->get());
    }

    // show the profile of the user with his posts
    public function profile(User $user)
    {
        return view('blog.profile')->with('categories',Category::all())
                                    ->with('user',$user)
                                    ->with('posts',Post::where('confirmed','=',1)->orderBy('created_at','desc')->where('user_id',$user->id)->get());
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
                // $avatar=$request->avatar->store('users');
                // Storage::delete($user->avatar);
                if ($user->avatar) {
                    unlink($user->avatar);
                }
                $image=$request->avatar;
                $name=time().$image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
                $destination=public_path('/users-avatars');
                $image->move($destination,$name);
                $user->update([
                    'avatar'=>'users-avatars/'.$name
                ]);
            }else{
                // $avatar=$request->avatar->store('users');
                $image=$request->avatar;
                $name=time().$image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
                $destination=public_path('/users-avatars');
                $image->move($destination,$name);
                $user->update([
                    'avatar'=>'users-avatars/'.$name
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
        session()->flash('success','profile updated successfuly');
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
        // $image=$request->image->store('posts');
        $image=$request->file('image');
        $name=time().$image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
        $destination=public_path('/posts-images');
        $image->move($destination,$name);
        $post=Post::create([
            'title'=>$request->title,
            'image'=>'posts-images/'.$name,
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
        session()->flash('success','post created successfuly please wait until the admin approve it');
        return redirect()->route('profile',auth()->user());
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
        session()->flash('success','post updated successfuly');
        return redirect()->route('single-post',$post->id);
    }


    // delete posts
    public function delete($id)
    {
        $post=Post::withTrashed()->where('id',$id)->first();
        // Storage::delete($post->image);
        unlink($post->image);
        $post->forceDelete();
        session()->flash('success','post deleted successfuly');
        return redirect()->route('profile',auth()->user());
    }

    // search for posts
    public function search(Request $request){
        return view('blog.result')->with('posts',Post::where('title','like','%'.request('query').'%')->paginate(12))
                        ->with('categories',Category::all())
                        ->with('query',request('query'));
    }
}
