<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\Court;
use App\Models\Address;

class JoinGameTest extends TestCase
{
    use WithoutMiddleware;

    /** @test */
    public function it_should_join_game_successfully()
    {
        $address = factory(Address::class)->make();
        $court = factory(Court::class)->make();

        $response = $this->post($this->courtUrl, array_merge($court->toArray(), $address->toArray()));

        $response->assertOk();
        $response->assertExactJson(['message' => 'Success!']);
    }

    /** @testsss */
    public function it_should_validate_join_game_parameters()
    {
        $address = factory(Address::class)->make();
        $court = factory(Court::class)->make();
        unset($court['address_id']);

        $paramKeys = array_keys(array_merge($court->toArray(), $address->toArray()));

        $header = [
            'Accept' => 'application/json'
        ];
        $response = $this->post($this->courtUrl, [], $header);
        // $response->dump();
        
        $response->assertStatus(422);
        $response->assertJsonValidationErrors($paramKeys);
        $response->assertJsonFragment(['message' => 'The given data was invalid.']);
    }
}
