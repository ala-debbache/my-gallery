<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\users\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;
use App\User;
use App\Post;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index')->with('users',User::all());
    }
    public function makeAdmin($id)
    {
        $user=User::where('id','=',$id)->first();
        $user->update([
            'isadmin'=>1
        ]);
        session()->flash('success','new admin added successfuly');
        return redirect(route('users.index'));
    }
    public function unmakeAdmin($id)
    {
        $count=User::where('isadmin','=',1)->get()->count();
        if($count>1){
            $user=User::where('id','=',$id)->first();
            $user->update([
                'isadmin'=>0
            ]);
            session()->flash('success','new admin deleted successfuly');
        }else{
            session()->flash('danger','you can not delete this admin');
        }
        return redirect(route('users.index'));
    }
    public function edit()
    {
        return view('admin.users.edit')->with('user',auth()->user());
    }
    public function update(UpdateUserRequest $request)
    {
        $user=auth()->user();
        if($request->hasFile('avatar')){
            // $avatar=$request->avatar->store('users');
            // Storage::delete($request->avatar);
            unlink($user->avatar);
            $image=$request->avatar;
            $name=time().$image->getClientOriginalName().'.'.$image->getClientOriginalExtension();
            $destination=public_path('/users-avatars');
            $image->move($destination,$name);
            $user->update([
                'name'=>$request->name,
                'avatar'=>'users-avatars/'.$name
            ]);
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
        session()->flash('success','user updated successfuly');
        return back();
    }
    public function delete($id)
    {
        $count=User::all()->count();
        $user=User::where('id','=',$id)->first();
        if (!$user->isadmin()) {
            foreach ($user->posts as $post) {
                $post->delete();
            }
            $user->delete();
            session()->flash('success','user deleted successfuly');
        }else if($count===1 || $user->isadmin()){
            session()->flash('danger','you can not delete this user');
        }
        return back();
    }
}
