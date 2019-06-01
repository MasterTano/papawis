<?php

namespace App\Services\Court;

use App\Models\Court as CourtModel;
use App\Services\ServiceInterface;
use App\Exceptions\ModelNotFoundException;

class UpdateCourtService implements ServiceInterface
{

    /**
     * Update court
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
        
        $res = $court->update($params);
        dd($res);
    }
}
