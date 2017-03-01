<?php

namespace App\Http\Controllers;

use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MessageController extends Controller
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
     * Inbox messages.
     *
     * @return $this
     */
    public function inbox()
    {
        $messages = Auth::user()->inbox;

        $user = Auth::user();

        $tags = Tag::latest()->limit(5)->get();

        return view('messages')->with(['messages' => $messages, 'user' => $user, 'tags' => $tags]);
    }

    /**
     * Outbox messages.
     *
     * @return $this
     */
    public function outbox()
    {
        $messages = Auth::user()->outbox;

        $user = Auth::user();

        $tags = Tag::latest()->limit(5)->get();

        return view('messages')->with(['messages' => $messages, 'user' => $user, 'tags' => $tags]);
    }
}
