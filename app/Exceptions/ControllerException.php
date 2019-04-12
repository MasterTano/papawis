<?php

namespace App\Exceptions;

use Exception;

class ControllerException extends BaseException
{
    public function render()
    {
        return response()->json([
            'error' => 'There is an error in your controller. Fix it biatch!!!'
        ]);
    }
}
