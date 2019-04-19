<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use App\Models\OAuthProvider;
use App\Http\Controllers\Controller;
use App\Exceptions\EmailTakenException;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class OAuthController extends Controller
{
    use AuthenticatesUsers;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // config([
        //     'services.github.redirect' => route('oauth.callback', 'google'),
        // ]);
    }

    /**
     * Redirect the user to the provider authentication page.
     *
     * @param  string $provider
     * @return \Illuminate\Http\RedirectResponse
     */
    public function redirectToProvider($provider)
    {
        return [
            'url' => Socialite::driver($provider)->stateless()->redirect()->getTargetUrl(),
        ];
    }

    /**
     * Obtain the user information from the provider.
     *
     * @param  string $driver
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        $socialUser = Socialite::driver($provider)->stateless()->user();

        $user = $this->findOrCreateUser($provider, $socialUser);

        $this->guard()->setToken(
            $token = $this->guard()->login($user)
        );

        return $this->respondWithToken((string) $token);
    }

    /**
     * @param  string $provider
     * @param  \Laravel\Socialite\Contracts\User $sUser
     * @return \App\User|false
     */
    protected function findOrCreateUser($provider, $socialUser)
    {
        $oauthProvider = OAuthProvider::where('provider', $provider)
            ->where('provider_user_id', $socialUser->getId())
            ->first();

        if ($oauthProvider) {
            $oauthProvider->update([
                'access_token' => $socialUser->token,
                'refresh_token' => $socialUser->refreshToken,
            ]);

            return $oauthProvider->user;
        }

        if (User::where('email', $socialUser->getEmail())->exists()) {
            throw new EmailTakenException;
        }

        return $this->createUser($provider, $socialUser);
    }

    /**
     * @param  string $provider
     * @param  \Laravel\Socialite\Contracts\User $sUser
     * @return \App\User
     */
    protected function createUser($provider, $socialUser)
    {
        $user = User::create([
            'firstname' => $socialUser->user['given_name'],
            'lastname' => $socialUser->user['family_name'],
            'email' => $socialUser->getEmail(),
        ]);

        $user->oauthProviders()->create([
            'provider' => $provider,
            'provider_user_id' => $socialUser->getId(),
            'access_token' => $socialUser->token,
            'refresh_token' => $socialUser->refreshToken,
        ]);

        return $user;
    }

    protected function respondWithToken(string $token)
    {
        return response()->json([
            'token' => $token,
            'token_type' => 'bearer',
            'expires_in' => $this->guard()->getPayload()->get('exp') - time(),
        ]);
    }
}
