<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\UserGame;
use Illuminate\Foundation\Testing\WithoutMiddleware;

class JoinGameTest extends TestCase
{
    use WithoutMiddleware;
    
    public  $url = '/api/games/join';

    /** @test */
    public function it_can_join_game()
    {
        $userGame = factory(UserGame::class)->make();

        $response = $this->post($this->url, $userGame->toArray());
        $response->assertOk();
        $response->assertExactJson(['message' => 'Success!']);
    }

    /** @test */
    public function it_can_validate_join_game_parameters()
    {
        $userGame = factory(UserGame::class)->make();

        $response = $this->json('POST', $this->url, []);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(array_keys($userGame->toArray()));
        $response->assertJsonFragment(['message' => 'The given data was invalid.']);
    }
}
