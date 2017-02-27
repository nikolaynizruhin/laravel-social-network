<?php

namespace App\Http\Controllers;

use App\Like;
use App\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LikeController extends Controller
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
     * Like a post.
     *
     * @param Post $post
     * @return \Illuminate\Http\RedirectResponse
     */
    public function likePost(Post $post)
    {
        $like = Like::whereLikeableType('App\Post')
            ->whereLikeableId($post->id)
            ->whereUserId(Auth::id())
            ->first();

        $like ? $like->delete() : Like::create([
            'user_id' => Auth::id(),
            'likeable_id' => $post->id,
            'likeable_type' => 'App\Post'
        ]);

        return back();
    }
}
