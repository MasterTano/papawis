<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BaseException extends Exception
{
    const HTTP_STATUS_CODE = Response::HTTP_BAD_REQUEST;

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        if (DB::transactionLevel() > 0) {
            DB::rollBack();
        }

        parent::__construct($message, $code, $previous);
    }

    public function render()
    {
        return response()->json(
            [
                'error' => 'There is an error in your controller. Fix it biatch!!!'
            ],
            self::HTTP_STATUS_CODE
        );
    }
}
