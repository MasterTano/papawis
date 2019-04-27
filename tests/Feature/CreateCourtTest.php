<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Laravel\Socialite\Two\User;
use Laravel\Socialite\Facades\Socialite;

class CreateCourtTest extends TestCase
{
    public $url = '/api/oauth/google/callback';

    public function testGetCourt()
    {
        $response = $this->get('/api/courts');
        // dd($response->getContent());
    }

    public function testCreateCourt()
    {
        $abstractUser = \Mockery::mock(User::class);

        $abstractUser->shouldReceive('getId')
            ->andReturn(1234567890)
            ->shouldReceive('getName')
            ->andReturn('Master Tano')
            ->shouldReceive('getEmail')
            ->andReturn(str_random(10).'@test.com')
            ->shouldReceive('getAvatar')
            ->andReturn('https://en.gravatar.com/userimage');

        $provider = \Mockery::mock('Laravel\Socialite\Contracts\Provider');

        $provider->shouldReceive('user')->andReturn($abstractUser);
        
        Socialite::shouldReceive('driver')->with('google')->andReturn($provider);

        $response = $this->get($this->url);

        dd($response->getContent());
    }
}
