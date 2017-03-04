<?php

namespace Tests\Browser;

use App\User;
use Faker\Factory;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class RegisterTest extends DuskTestCase
{
    /**
     * A User can register.
     *
     * @return void
     */
    public function testUserCanRegister()
    {
        $user = factory(User::class)->make();

        $faker = Factory::create();

        $this->browse(function ($browser) use ($user, $faker) {
            $browser->visit('/register')
                    ->type('name', $user->name)
                    ->type('username', $user->username)
                    ->type('email', $user->email)
                    ->keys('#birthday', '{backspace}')
                    ->keys('#birthday', $faker->date($format = 'd', $max = 'now'))
                    ->keys('#birthday', '{backspace}')
                    ->keys('#birthday', $faker->date($format = 'm', $max = 'now'))
                    ->keys('#birthday', '{backspace}')
                    ->keys('#birthday', $faker->date($format = 'Y', $max = 'now'))
                    ->type('location', $user->location)
                    ->type('website', $user->website)
                    ->type('password', $user->password)
                    ->type('password_confirmation', $user->password)
                    ->press('Register')
                    ->assertPathIs('/');
        });
    }
}
