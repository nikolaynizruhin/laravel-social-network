<?php

namespace Tests\Feature;

use App\User;
use Tests\TestCase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class AvatarUploadTest extends TestCase
{
    use WithoutMiddleware;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testAvatarUpload()
    {
        $user = factory(User::class)->create();

        $this->actingAs($user)->json('POST', '/profile', [
            'avatar' => UploadedFile::fake()->image('avatar.jpg')
        ]);

        $this->assertTrue($user->avatar !== 'default.jpg');
    }
}
