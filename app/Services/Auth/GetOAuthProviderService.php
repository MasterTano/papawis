<?php

namespace App\Services\Auth;

use Laravel\Socialite\Two\User;
use App\Services\ServiceInterface;
use App\Models\OAuthProvider;

class GetOAuthProviderService implements ServiceInterface
{
    public function execute(array $params)
    {
        return OAuthProvider::where('provider', $params['provider'])
            ->where('provider_user_id', $params['id'])
            ->first();
    }
}
