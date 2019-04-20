<?php

namespace App\Services;

use Laravel\Socialite\Two\User;

interface SocialLoginServiceInterface
{
    /**
     * Login user if exist. If not, create it first then login.
     *
     * @param string $provider
     * @param User $socialUser
     * @return string
     */
    public function execute(string $provider, User $socialUser): string;
}
