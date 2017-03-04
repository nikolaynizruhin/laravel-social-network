<?php

namespace Tests\Browser;

use App\User;
use Faker\Factory;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class PostCreateTest extends DuskTestCase
{
    /**
     * A User can create post.
     *
     * @return void
     */
    public function testUserCanCreatePost()
    {
        $user = factory(User::class)->create();

        $faker = Factory::create();
        $body = $faker->text($maxNbChars = 200);

        $this->browse(function ($browser) use ($user, $body) {
            $browser->loginAs($user)
                    ->visit('/' . $user->username)
                    ->type('body', $body)
                    ->press('Submit')
                    ->assertSee($body);
        });
    }
}
