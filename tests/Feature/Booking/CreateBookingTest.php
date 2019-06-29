<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use App\Models\Address;
use App\Models\Booking;

class CreateBookingTest extends TestCase
{
    use WithoutMiddleware;
    /**
     * Undocumented variable
     *
     * @var \Faker\Generator
     */
    public $faker;

    public function setup() : void
    {
        parent::setup();
    }

    public $url = '/api/bookings';

    /** @test */
    public function it_can_create_booking()
    {
        $bookingParams = factory(Booking::class)->make()->toArray();

        $response = $this->post($this->url, $bookingParams);
        $response->assertOk();
        $response->assertExactJson(['message' => 'Success!']);
        $this->assertDatabaseHas((new Booking())->getTable(), $bookingParams);
    }

    /** @test */
    public function it_can_validate_create_booking_parameters()
    {
        $bookingParams = factory(Booking::class)->make()->toArray();

        $response = $this->post($this->url, [], ['Accept' => 'application/json']);
        $response->assertStatus(422);
        $response->assertJsonValidationErrors(array_keys($bookingParams));
        $response->assertJsonFragment(['message' => 'The given data was invalid.']);
    }
}
