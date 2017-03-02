<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;

class TagController extends Controller
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
     * Display the specified posts by tag.
     *
     * @param  Tag $tag
     * @return $this
     */
    public function show(Tag $tag)
    {
        $tags = Tag::latest()->limit(5)->get();

        $posts = $tag->posts()->paginate(10);

        return view('home')->with([
            'posts' => $posts,
            'user' => auth()->user(),
            'tags' => $tags
        ]);
    }
}
