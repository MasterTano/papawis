<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\Court;
use App\Models\Address;

class GetCourtTest extends TestCase
{
    use WithoutMiddleware;
    use CourtTrait;

    /** @test */
    public function it_should_get_court_successfully()
    {
        $address = factory(Address::class)->create();
        $court = factory(Court::class)->create(['address_id' => $address->address_id]);
        $response = $this->get($this->courtUrl . $court->court_id);
        $response->assertOk();
        $response->assertJson($court->toArray());
    }
}
