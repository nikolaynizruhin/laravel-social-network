<?php

namespace App\Http\Controllers;

use App\Post;
use App\Tag;
use App\User;
use Illuminate\Http\Request;

class PostController extends Controller
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
     * Store a new post.
     *
     * @param  Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'body' => 'required|max:255',
        ]);

        $postBody = $this->parseUsernames($request->body);
        $parsed = $this->parseTags($postBody);

        list($body, $tagIds) = $parsed;

        $post = Post::create([
            'user_id' => auth()->user()->id,
            'body' => $body
        ]);

        empty($tagIds) ? : $post->tags()->sync(array_unique($tagIds));

        return back();
    }

    /**
     * Remove the specified post from storage.
     *
     * @param  Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        $post->delete();
        return back();
    }

    /**
     * Parse usernames from post body.
     *
     * @param  string $postBody
     * @return string
     */
    private function parseUsernames($postBody)
    {
        preg_match_all("/@(\\w+)/", $postBody, $usernames);

        if (!empty($usernames)) {
            foreach ($usernames[1] as $username) {
                if (!User::whereUsername($username)->get()->isEmpty()) {
                    $postBody = preg_replace("/(@\\w+)/", '<a href="/' . $username . '">${1}</a>', $postBody);
                    // notify
                }
            }
        }

        return $postBody;
    }

    /**
     * Parse hash tags from post body.
     *
     * @param  string $postBody
     * @return array
     */
    private function parseTags($postBody)
    {
        preg_match_all("/#(\\w+)/", $postBody, $tagnames);

        $tagIds = [];

        if (!empty($tagnames[1])) {
            foreach ($tagnames[1] as $tagname) {
                if (Tag::whereName($tagname)->get()->isEmpty()) {
                    $tag = new Tag();
                    $tag->name = $tagname;
                    $tag->save();
                    $tagIds[] = $tag->id;
                } else {
                    $tag = Tag::whereName($tagname)->first();
                    $tagIds[] = $tag->id;
                }
                $postBody = preg_replace("/(#\\w+)/", '<a href="/tags/' . $tag->id . '">${1}</a>', $postBody);
            }
        }

        return [$postBody, $tagIds];
    }
}
