<?php

namespace App\Services\Address;

use App\Models\Address as AddressModel;
use App\Services\ServiceInterface;

class CreateAddressService implements ServiceInterface
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
