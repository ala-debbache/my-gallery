<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Post;
use App\Category;
use App\Tag;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('admin.home')->with('users',User::all()->count())
                            ->with('unconfirmed',Post::where('confirmed','=',0)->get()->count())
                            ->with('shared',Post::where('confirmed','=',1)->get()->count())
                            ->with('trashed',Post::onlyTrashed()->get()->count())
                            ->with('categories',Category::all()->count())
                            ->with('tags',Tag::all()->count());
    }
}
