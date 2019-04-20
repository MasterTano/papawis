<?php

namespace App\Services\Address;

use App\Models\Address as AddressModel;
use App\Services\ActionServiceInterface;

class CreateAddressService implements ActionServiceInterface
{
    /**
     * Create AddressModel and Address
     *
     * @param array $params
     * @return AddressModel
     */
    public function execute(array $params)
    {
        return AddressModel::create($params);
    }
}
