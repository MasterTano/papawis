<?php

namespace App\Services\Court;

use App\Models\Court as CourtModel;
use App\Services\ActionServiceInterface;
use App\Exceptions\ModelNotFoundException;

class GetCourtService implements ActionServiceInterface
{

    /**
     * Create CourtModel and Address
     *
     * @param array $params
     * @return CourtModel
     */
    public function execute(array $params)
    {
        $court = CourtModel::find($params['id']);

        if (!$court) {
            throw new ModelNotFoundException();
        }
        
        if (!$court->address()->exists()) {
            throw new ModelNotFoundException('Court address not found');
        }

        return $court->with('address')->first();
    }
}
