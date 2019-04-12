<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Exceptions\ControllerException;

class TestController extends Controller
{
    public function test()
    {
        throw new ControllerException();
    }
}
