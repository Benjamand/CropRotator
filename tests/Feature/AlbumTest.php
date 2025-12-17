<?php

namespace Tests\Feature;

use App\Models\Album;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AlbumTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function createTest(): void
    {
        $this->assertEquals(0, Album::all()->count());
        $data = [
            'id' => 1,
            'name' => 'TEST'
        ];

        $response = $this->post('/album', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/album');
        $response->assertEquals(1, Album::all()->count());
    }

    public function updateTest(): void
    {
        $this->assertEquals(0, Album::all()->count());
        $data = [
            'id' => 1,
            'name' => 'TEST'
        ];

        $response = $this->post('/album', $data);

        $response->assertStatus(302);
        $response->assertRedirect('/album');
        $response->assertEquals(1, Album::all()->count());
    }
}
