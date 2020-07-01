<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\users\UpdateUserRequest;
use Illuminate\Support\Facades\Storage;
use App\User;

class UsersController extends Controller
{
    public function index()
    {
        return view('admin.users.index')->with('users',User::all());
    }
    public function makeAdmin($id)
    {
        $user=User::where('id',$id);
        $user->update([
            'isadmin'=>1
        ]);
        session()->flash('success','user updated successfuly');
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
            $avatar=$request->avatar->store('users');
            Storage::delete($request->avatar);
            $user->update([
                'name'=>$request->name,
                'avatar'=>$avatar
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
        return redirect(route('users.index'));
    }
}
