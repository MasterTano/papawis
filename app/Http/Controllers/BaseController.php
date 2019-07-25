<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;

class BaseController extends Controller
{
    public function sendErrorJson(
        array $errors = [],
        string $message = 'Error!',
        int $status = Response::HTTP_BAD_REQUEST,
        array $headers = []
    ) {
        $data = [ 'message' => $message ];
        $data['errors'] = $errors;
        
        return $this->sendJson($data, $status, $headers);
    }

    public function sendSuccessJson(
        array $data = [],
        string $message = 'Success!',
        array $headers = []
    ) {
        if (!$data) {
            $data['message'] = $message;
        }
        return $this->sendJson($data, Response::HTTP_OK, $headers);
    }

    private function sendJson(array $data, int $status = Response::HTTP_OK, array $headers = [])
    {
        return response()->json(
            $data,
            $status,
            $headers
        );
    }
}
