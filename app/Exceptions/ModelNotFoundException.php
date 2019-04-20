<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ModelNotFoundException extends BaseException
{
    public function render()
    {
        return response()->json([
            'error' => 'Model not found!',
            'message' => 'We cannot find what you are looking for.'
        ], Response::HTTP_NOT_FOUND);
    }
}
