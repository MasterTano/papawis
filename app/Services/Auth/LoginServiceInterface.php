<?php

namespace App\Services;



interface LoginServiceInterface
{
    /**
     * Login user
     *
     * @return array
     */
    public function login();
}