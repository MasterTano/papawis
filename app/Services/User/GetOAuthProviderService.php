<?php

namespace App\Services\User;

use Laravel\Socialite\Two\User;
use App\Services\ActionServiceInterface;
use App\Models\OAuthProvider;

class GetOAuthProviderService implements ActionServiceInterface
{
    public function execute(array $params)
    {
        return OAuthProvider::where('provider', $params['provider'])
            ->where('provider_user_id', $params['id'])
            ->first();
    }
}
