<?php

namespace App\Http\Controllers;

use App\Tag;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FollowController extends Controller
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
     * Follow the user.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function follow(User $user)
    {
        $user->followers()->sync([Auth::user()->id], false);

        return back();
    }

    /**
     * Unfollow the user.
     *
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     */
    public function unfollow(User $user)
    {
        Auth::user()->followees()->detach($user->id);

        return back();
    }

    /**
     * Show list of followers.
     *
     * @param  User $user
     * @return $this
     */
    public function followers(User $user)
    {
        $tags = Tag::latest()->limit(5)->get();

        return view('followers')->with(['user' => $user, 'tags' => $tags]);
    }

    /**
     * Show list of followees.
     *
     * @param  User $user
     * @return $this
     */
    public function followees(User $user)
    {
        $tags = Tag::latest()->limit(5)->get();

        return view('followees')->with(['user' => $user, 'tags' => $tags]);
    }
}
