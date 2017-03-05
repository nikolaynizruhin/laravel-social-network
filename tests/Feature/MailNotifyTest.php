<?php

namespace Tests\Feature;

use App\Mail\PostReply;
use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class MailNotifyTest extends TestCase
{
    /**
     * A mail notify.
     *
     * @return void
     */
    public function testMailNotify()
    {
        Mail::fake();

        $user = factory(User::class)->create();
        $secondUser = factory(User::class)->create();

        $this->actingAs($user)
             ->json('POST', '/posts', [
                 'body' => '@' . $secondUser->username
             ]);

        Mail::assertSent(PostReply::class, function ($mail) use ($secondUser) {
            return $mail->hasTo($secondUser->email);
        });
    }
}
