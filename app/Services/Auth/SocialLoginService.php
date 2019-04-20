<?php

namespace App\Services\Auth;

use Laravel\Socialite\Two\User;
use App\Models\User as UserModel;
use App\Exceptions\EmailTakenException;
use App\Services\User\CreateUserService;
use App\Services\SocialLoginServiceInterface;
use App\Services\User\GetOAuthProviderService;

class SocialLoginService implements SocialLoginServiceInterface
{
    /**
     * @inheritDoc
     */
    public function execute(string $provider, User $socialUser) : string
    {
        $user = $this->findOrCreateUser($provider, $socialUser);
        
        $token = auth()->guard()->login($user);

        auth()->guard()->setToken($token);

        return $token;
    }

    /**
     * Find or create user
     *
     * @param [type] $provider
     * @param [type] $socialUser
     * @return void
     */
    protected function findOrCreateUser($provider, $socialUser)
    {
        $oAuthProvider = (new GetOAuthProviderService())->execute([
            'id' => $socialUser->getId(),
            'provider' => $provider
        ]);

        if ($oAuthProvider) {
            $oAuthProvider->update([
                'access_token' => $socialUser->token,
                'refresh_token' => $socialUser->refreshToken,
            ]);
            return $oAuthProvider->user;
        }

        if (UserModel::where('email', $socialUser->getEmail())->exists()) {
            throw new EmailTakenException();
        }
        
        return (new CreateUserService())->execute([
            'firstname' => $socialUser->user['given_name'],
            'lastname' => $socialUser->user['family_name'],
            'email' => $socialUser->getEmail(),
            'provider' => $provider,
            'provider_user_id' => $socialUser->getId(),
            'access_token' => $socialUser->token,
            'refresh_token' => $socialUser->refreshToken,
        ]);
    }   
}
