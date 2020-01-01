<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    public function apiResponse($httpCode, $data = null, $message = '')
    {
        if (! isset(Response::$statusTexts[$httpCode])) {
            $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        if (!is_null($data) && !is_array($data) && !is_object($data)) {
            $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }
        $body = [
            'code' => $httpCode,
            'message' => empty($message) ? Response::$statusTexts[$httpCode] : $message,
            'data' => $data
        ];
        return response()->json($body, $httpCode);
    }
}
