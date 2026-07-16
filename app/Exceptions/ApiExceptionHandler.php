<?php

namespace App\Exceptions;

use Illuminate\Http\JsonResponse;

class ApiExceptionHandler
{
    public static function error(
        string $message,
        int $status = 500,
        array $errors = []
    ): JsonResponse {
        return response()->json([
            'success' => false,
            'message' => $message,
            'errors' => $errors,
        ], $status);
    }
}