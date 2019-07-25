<?php

namespace App\Services\User;

use App\Models\User as UserModel;
use App\Services\ServiceInterface;

class CreateUserService implements ServiceInterface
{
    /**
     * Create UserModel and OAuthProvider
     *
     * @param array $params
     * @return UserModel
     */
    public function execute(array $params)
    {
        $user = UserModel::create($params);
        
        $user->oauthProviders()->create($params);

        return $user;
    }
}
