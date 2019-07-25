<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Illuminate\Support\Facades\Artisan;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected function setup() : void
    {
        parent::setup();

        if (env('DB_CONNECTION') === 'sqlite') {
            Artisan::call('migrate:fresh');
            Artisan::call('db:seed');
        }
    }
}
