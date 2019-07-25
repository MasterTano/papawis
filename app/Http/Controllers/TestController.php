<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Exceptions\ControllerException;
use App\Repositories\UserRepository;

class TestController extends BaseController
{
    /**
     * @var UserRepository
     */
    protected $userRepository;
    
    /**
     * Class constructor.
     */
    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function test()
    {
        throw new ControllerException();
    }

    public function getUsers(UserRepository $userRepository)
    {
        return $userRepository->all();
    }
}
