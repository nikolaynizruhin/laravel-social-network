<?php

namespace Tests\Browser;

use App\User;
use Faker\Factory;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SendMessageTest extends DuskTestCase
{
    /**
     * A User can send message.
     *
     * @return void
     */
    public function testSendMessage()
    {
        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $faker = Factory::create();
        $body = $faker->text($maxNbChars = 50);

        $this->browse(function ($browser) use ($user, $secondUser, $body) {
            $browser->loginAs($user)
                ->visit('/outbox')
                ->select('to', $secondUser->username)
                ->type('body', $body)
                ->press('Send')
                ->assertSee($body);
        });
    }
}
