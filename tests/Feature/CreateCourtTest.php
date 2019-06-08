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
       
    }
}
