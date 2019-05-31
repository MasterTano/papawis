<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ModelNotFoundException extends BaseException
{
    protected $code = Response::HTTP_NOT_FOUND;

    public function render()
    {
        return response()->json([
            'error' => 'Model not found!',
            'message' => 'We cannot find what you are looking for.'
        ], $this->getCode());
    }
}
