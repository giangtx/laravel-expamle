<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    /////////////////////////
    // Response status codes
    /////////////////////////
    const STATUS_SUCCESS = 1;
    const STATUS_FAILURE = 0;

    ////////////////////////
    // Response error codes
    ////////////////////////

    // Error recognized as a client issue (unauthorized, bad request, etc)
    const ERROR_CLIENT = 'CLIENT_ISSUE';
    // Error recognized as a server issue
    const ERROR_SERVER = 'SERVER_ISSUE';

    /**
     * Generate a json error response for client-errors (bad request, unauthorized, etc).
     * @param string $errorMessage the error message
     * @param int $statusCode the HTTP status code to send with the response
     * @param string $errorCode
     * @return JsonResponse
     */
    protected function clientErrorResponse(string $errorMessage, int $statusCode, string $errorCode = self::ERROR_CLIENT)
    {
        return response()->json([
            'status' => self::STATUS_FAILURE,
            'msg' => $errorMessage,
            'errorCode' => $errorCode
        ], $statusCode);
    }

    protected function clientValidationErrorResponse(array $errors)
    {
        return response()->json([
            'status' => self::STATUS_FAILURE,
            'errors' => $errors,
        ], Response::HTTP_BAD_REQUEST);
    }

    /**
     * Log an internal server error for an exception with a unique string for debugging. Send the same unique string in a json error response.
     * @param string $methodName the name of the method, for debug log
     * @param Exception $e the exception to log
     * @return JsonResponse
     */
    protected function internalServerErrorResponse(string $methodName, Exception $e)
    {
        // Log error and return response with a unique error id for debugging
        $errorId = uniqid("", true);
        Log::error("{$methodName}: errorId {$errorId}, message {$e->getMessage()}, stack {$e->getTraceAsString()}");
        return response()->json([
            'status' => self::STATUS_FAILURE,
            'msg' => "Server error: {$errorId}.",
            'errorCode' => self::ERROR_SERVER,
            'errorId' => $errorId,
        ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
