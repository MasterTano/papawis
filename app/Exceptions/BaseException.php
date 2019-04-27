<?php

namespace App\Exceptions;

use Exception;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Response;

class BaseException extends Exception
{
    const DEFAULT_STATUS_CODE = Response::HTTP_BAD_REQUEST;
    const DEFAULT_MESSAGE = 'An error has occured.';

    public function __construct(string $message = "", int $code = 0, Throwable $previous = null)
    {
        if (DB::transactionLevel() > 0) {
            DB::rollBack();
        }

        parent::__construct($message, $code, $previous);
    }

    // public function render()
    // {
    //     return response()->json(
    //         [
    //             'error' => $this->message ?: self::DEFAULT_MESSAGE
    //         ],
    //         $this->code ?: self::DEFAULT_STATUS_CODE
    //     );
    // }

    public function report()
    {
        return response()->json(
            [
                'error' => $this->message ?: self::DEFAULT_MESSAGE
            ],
            $this->code ?: self::DEFAULT_STATUS_CODE
        );
    }
}
