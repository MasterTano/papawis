<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Laravel\Socialite\Facades\Socialite;
use App\Services\Auth\SocialLoginService;
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
     * Obtain the user information from the provider. Then register and/or login the user
     *
     * @param  string $provider
     * @return \Illuminate\Http\Response
     */
    public function handleProviderCallback($provider)
    {
        return DB::transaction(function() use ($provider) {
            $socialUser = Socialite::driver($provider)->stateless()->user();

            $token = (new SocialLoginService())->execute($provider, $socialUser);

            return [
                'token' => $token,
                'token_type' => 'bearer',
                'expires_in' => auth()->guard()->getPayload()->get('exp') - time(),
            ];
        });
    }
}
