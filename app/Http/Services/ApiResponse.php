<?php

namespace App\Http\Services;
use Carbon\Carbon;
use Illuminate\Support\Str;

class ApiResponse
{
    public static function format($status = 500, $message = '',$responseCode = '',$responseType = 'Success', $data = [],$headers = []): \Illuminate\Http\JsonResponse
    {
        http_response_code($status);
        header('Content-Type:application/json');
        $responseData = [
            'responseTime' => Carbon::now()->timestamp,
            'status' => $status,
            'responseCode' => $responseCode,
            'response' => $responseType,
            'message' => $message,
            'data' => $data
        ];

        return response()->json($responseData, $status,$headers);
    }
}
