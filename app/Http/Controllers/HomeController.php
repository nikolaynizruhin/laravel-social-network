<?php

namespace App\Http\Controllers;

use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
     * Show user news feed.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $followees = Auth::user()->followees()->pluck('id')->all();

        array_push($followees, Auth::user()->id);

        $posts = Post::whereIn('user_id', $followees)->latest()->get();

        return view('home', ['user' => Auth::user(), 'posts' => $posts]);
    }
}
