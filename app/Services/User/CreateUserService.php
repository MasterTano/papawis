<?php

namespace App\Services\User;

use App\Models\User as UserModel;
use App\Services\ActionServiceInterface;

class CreateUserService implements ActionServiceInterface
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
