<?php

namespace Tests\Browser;

use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AlbumTest extends DuskTestCase
{
    use DatabaseMigrations;
    /**
     * A Dusk test example.
     */

    protected $baseUrl = 'http://127.0.0.1:8000';

    /** @test */
    public function test_CreateTest()
    {
        $data = [
            'name' => 'TEST',
            'email' => 'test@gmail.com',
            'password' => 'password'
        ];
        $user = User::create($data);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user);
            $browser->visit('/create')
                ->assertPathIs('/create')
                    ->typeSlowly('albumName', 'Test name', 100)
                    ->press('#submitButton')
                    ->assertPathIs('/')
                    ->assertSee('Test name');
        });
    }

    public function test_UpdateTest()
    {
        $data = [
            'name' => 'TEST',
            'email' => 'test@gmail.com',
            'password' => 'password'
        ];
        $user = User::create($data);
        $this->browse(function (Browser $browser) use ($user) {
            $browser->loginAs($user);
            $browser->visit('/create')
                ->assertPathIs('/create')
                ->typeSlowly('albumName', 'Test name', 100)
                ->press('#submitButton')
                ->assertPathIs('/')
                ->press('Profile')
                ->assertSee('Test name')
                ->press('.editButton')
                ->typeSlowly('#name', 'edited name', 100)
                ->assertPathIs('/profile')
                ->assertSee('edited name');
        });
    }
}
