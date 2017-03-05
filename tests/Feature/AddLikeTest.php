<?php

namespace Tests\Feature;

use App\Post;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AddLikeTest extends TestCase
{
    /**
     * A User can like post.
     *
     * @return void
     */
    public function testAddLikeToPost()
    {
        $post = factory(Post::class)->create();

        $this->actingAs($post->user)
                ->get('/posts/' . $post->id . '/like');

        $this->assertDatabaseHas('likeables', [
            'user_id' => $post->user->id,
            'likeable_id' => $post->id,
            'likeable_type' => 'App\Post'
        ]);
    }
}
