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
    public function it_should_create_court_successfully()
    {
        $address = factory(Address::class)->make();
        $court = factory(Court::class)->make();
        unset($court['address_id']);

        $response = $this->post($this->courtUrl, array_merge($court->toArray(), $address->toArray()));

        $response->assertOk();
        $response->assertExactJson(['message' => 'Success!']);
    }
}
