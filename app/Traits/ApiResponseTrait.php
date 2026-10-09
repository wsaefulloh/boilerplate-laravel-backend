<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

trait ApiResponseTrait
{
    /**
     * Success Response
     *
     * @param mixed $data
     * @param string $message
     * @param int $code
     * @return JsonResponse
     */
    public function successResponse(mixed $data = null, string $message = 'Success', int $code = Response::HTTP_OK): JsonResponse
    {
        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $data,
        ], $code);
    }

    /**
     * Error Response
     *
     * @param string $message
     * @param int $code
     * @param mixed $errors
     * @return JsonResponse
     */
    public function errorResponse(string $message = 'An error occurred', int $code = Response::HTTP_BAD_REQUEST, mixed $errors = null): JsonResponse
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if ($errors !== null) {
            $response['errors'] = $errors;
        }

        return response()->json($response, $code);
    }

    /**
     * Created Response (201)
     *
     * @param mixed $data
     * @param string $message
     * @return JsonResponse
     */
    public function createdResponse(mixed $data = null, string $message = 'Resource created successfully'): JsonResponse
    {
        return $this->successResponse($data, $message, Response::HTTP_CREATED);
    }

    /**
     * Paginated Response
     *
     * @param mixed $paginatedData
     * @param string $message
     * @return JsonResponse
     */
    public function paginatedResponse(mixed $paginatedData, string $message = 'Data retrieved successfully'): JsonResponse
    {
        $response = $paginatedData->response()->getData(true);

        return response()->json([
            'success' => true,
            'message' => $message,
            'data'    => $response['data'],
            'meta'    => $response['meta'] ?? null,
            'links'   => $response['links'] ?? null,
        ], Response::HTTP_OK);
    }

    /**
     * Unauthorized Response (401)
     *
     * @param string $message
     * @return JsonResponse
     */
    public function unauthorizedResponse(string $message = 'Unauthenticated'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_UNAUTHORIZED);
    }

    /**
     * Forbidden Response (403)
     *
     * @param string $message
     * @return JsonResponse
     */
    public function forbiddenResponse(string $message = 'Access forbidden'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_FORBIDDEN);
    }

    /**
     * Not Found Response (404)
     *
     * @param string $message
     * @return JsonResponse
     */
    public function notFoundResponse(string $message = 'Resource not found'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_NOT_FOUND);
    }

    /**
     * Validation Error Response (422)
     *
     * @param mixed $errors
     * @param string $message
     * @return JsonResponse
     */
    public function validationErrorResponse(mixed $errors, string $message = 'Validation failed'): JsonResponse
    {
        return $this->errorResponse($message, Response::HTTP_UNPROCESSABLE_ENTITY, $errors);
    }
}
