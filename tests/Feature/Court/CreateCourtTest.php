<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\Court;
use App\Models\Address;

class CreateCourtTest extends TestCase
{
    use WithoutMiddleware;
    use CourtTrait;

    /** @test */
    public function it_can_create_court()
    {
        $address = factory(Address::class)->make();
        $court = factory(Court::class)->make();
        unset($court['address_id']);

        $response = $this->post($this->courtUrl, array_merge($court->toArray(), $address->toArray()));

        $response->assertOk();
        $response->assertExactJson(['message' => 'Success!']);
    }

    /** @test */
    public function it_can_validate_create_court_parameters()
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
