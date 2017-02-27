<?php

namespace App\Http\Controllers;

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
}
