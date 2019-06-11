<?php

namespace Tests\Unit;

use App\User;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function testBasicTest()
    {
        $user = User::find(13);
        $this->actingAs($user)->post('/api/like/16', ['model' => "App\Models\Comment"])
            ->assertStatus(200)
            ->assertJsonStructure(['rating', 'success']);

        //        $this->assertTrue(true);
    }

    public function testNoUser() {
        $test = $this->post('/api/like/16', ['model' => "App\Models\Comment"])
        ->assertStatus(401);

    }
}
