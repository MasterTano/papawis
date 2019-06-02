<?php

namespace App\Services;

use App\Models\Booking;
use App\Services\ServiceInterface;

class CreateBookingService implements ServiceInterface
{
    /**
     * Create Booking and OAuthProvider
     *
     * @param array $params
     * @return Booking
     */
    public function execute(array $params)
    {
        $booking = Booking::create($params);
        dd($booking);
        return $booking;
    }
}
