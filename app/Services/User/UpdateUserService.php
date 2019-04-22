<?php

namespace App\Services\User;

use App\Models\User as UserModel;
use App\Services\ServiceInterface;
use App\Exceptions\ModelNotFoundException;

class UpdateUserService implements ServiceInterface
{
    /**
     * Create UserModel and OAuthProvider
     *
     * @param array $params
     * @return UserModel
     */
    public function execute(array $params)
    {
        if (!$user = UserModel::find($params['user_id'])) {
            throw new ModelNotFoundException();
        }
        return $user->update($params);
    }
}
