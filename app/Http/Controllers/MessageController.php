<?php

namespace App\Http\Controllers;

use App\Message;
use App\Tag;
use App\User;
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
     * Store a message.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'to' => 'required|integer',
            'body' => 'required|max:255',
        ]);

        Message::create([
            'from_user_id' => Auth::id(),
            'to_user_id' => $request->to,
            'body' => $request->body
        ]);

        return back();
    }

    /**
     * Inbox messages.
     *
     * @return $this
     */
    public function inbox()
    {
        $messages = Auth::user()->inbox()->latest()->get();

        $user = Auth::user();

        $recipients = User::where('id', '!=', Auth::id())->get();

        $tags = Tag::latest()->limit(5)->get();

        return view('messages')->with([
            'messages' => $messages,
            'user' => $user,
            'tags' => $tags,
            'recipients' => $recipients
        ]);
    }

    /**
     * Outbox messages.
     *
     * @return $this
     */
    public function outbox()
    {
        $messages = Auth::user()->outbox()->latest()->get();

        $user = Auth::user();

        $recipients = User::where('id', '!=', Auth::id())->get();

        $tags = Tag::latest()->limit(5)->get();

        return view('messages')->with([
            'messages' => $messages,
            'user' => $user,
            'tags' => $tags,
            'recipients' => $recipients
        ]);
    }
}
