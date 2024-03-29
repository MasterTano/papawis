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
    public function it_can_get_court()
    {
        $address = factory(Address::class)->create();
        $court = factory(Court::class)->create(['address_id' => $address->address_id]);
        $response = $this->get($this->courtUrl . $court->court_id);
        $response->assertOk();
        $response->assertJson($court->toArray());
    }

    /** @test */
    public function it_can_return_404()
    {
        $response = $this->get($this->courtUrl . 'ID_DOES_NOT_EXISTS');
        $response->assertNotFound();
    }
}
