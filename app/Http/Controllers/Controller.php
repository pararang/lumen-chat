<?php

namespace App\Http\Controllers;

use Laravel\Lumen\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    /**
     * @param int $httpCode
     * @param mixed $data
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    public function apiResponse(int $httpCode, $data = null, $message = '')
    {
        // validate accepted httpCode
        if (! isset(Response::$statusTexts[$httpCode])) {
            $this->apiResponse(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        // data must be and array or object or null
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
