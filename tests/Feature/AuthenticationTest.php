<?php

namespace Tests\Feature;

use Tests\TestCase;
use Laravel\Socialite\Two\User;
use Laravel\Socialite\Facades\Socialite;

/**
 * @
 */
class AuthenticationTest extends TestCase
{

    /** @test */
    public function it_can_authenticate()
    {
        $params = [
            'id' => rand(100000, 10000000000),
            'email' => str_random(8) . '@email.com'
        ];

        $abstractUser = \Mockery::mock('Laravel\Socialite\Two\User');
        $abstractUser->shouldReceive('getId')
            ->andReturn($params['id'])
            ->shouldReceive('getEmail')
            ->andReturn($params['email'])
            ->shouldReceive('getName')
            ->andReturn('Master Tano')
            ->shouldReceive('getNickname')
            ->andReturn('Tano')
            ->shouldReceive('getRaw')
            ->andReturn([
                'given_name'=>'Cristian',
                'family_name'=>'Cardino'
            ]);

        $provider = \Mockery::mock('Laravel\Socialite\Contracts\Provider');
        $provider->shouldReceive('user')->andReturn($abstractUser);
        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $response = $this->get('/api/oauth/google/callback');
        $response->assertOk();
        $response->assertJsonStructure([
            'expires_in',
            'token',
            'token_type'
        ]);
    }
}

