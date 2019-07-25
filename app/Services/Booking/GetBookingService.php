<?php

namespace App\Services;

use App\Models\Booking;
use App\Services\ServiceInterface;
use App\Exceptions\ModelNotFoundException;

class GetBookingService implements ServiceInterface
{
    /**
     * Create Booking and OAuthProvider
     *
     * @param array $params
     * @return Booking
     */
    public function execute(array $params)
    {
        $booking = Booking::with(['user', 'court'])->find($params['id']);
        if (!$booking) {
            throw new ModelNotFoundException();
        }
        return $booking;
    }
}
