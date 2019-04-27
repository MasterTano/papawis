<?php

namespace App\Exceptions;

use Illuminate\Http\Response;

class ModelNotFoundException extends BaseException
{
    const DEFAULT_MESSAGE = 'We cannot find what you are looking for.';

    public function render()
    {
        $message = $this->getMessage() ?: self::DEFAULT_MESSAGE;
        return response()->json([
            'error' => 'Model not found!',
            'message' => $message
        ], Response::HTTP_NOT_FOUND);
    }
}
