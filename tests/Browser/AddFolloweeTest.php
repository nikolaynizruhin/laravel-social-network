<?php

namespace Tests\Browser;

use App\User;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AddFolloweeTest extends DuskTestCase
{
    /**
     * User can followee another user.
     *
     * @return void
     */
    public function testAddFollowee()
    {
        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $this->browse(function ($browser) use ($user, $secondUser) {
            $browser->loginAs($user)
                ->visit('/' . $secondUser->username)
                ->press('Follow')
                ->visit('/' . $user->username . '/followees')
                ->assertSee($secondUser->name);
        });
    }
}
