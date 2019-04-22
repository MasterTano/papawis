<?php

namespace App\Services\Court;

use App\Models\Court as CourtModel;
use App\Services\ServiceInterface;
use App\Services\Address\CreateAddressService;

class CreateCourtService implements ServiceInterface
{

    protected $createAddressService;

    public function __construct(CreateAddressService $createAddressService)
    {
        $this->createAddressService = $createAddressService;
    }
    /**
     * Create CourtModel and Address
     *
     * @param array $params
     * @return CourtModel
     */
    public function execute(array $params)
    {
        $address = $this->createAddressService->execute($params);

        $court = CourtModel::create(array_merge(
            [ 'address_id' => $address->address_id ],
            $params
        ));

        return $court;
        
        // $court = CourtModel::create($params);
        
        // $court->address()->create($params);

    }
}
