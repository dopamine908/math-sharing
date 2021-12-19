<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected function validationExceptionHandling(ValidationException $exception): JsonResponse
    {
        return response()
            ->json(
                [
                    'message' => $exception->errors(),
                ],
                Response::HTTP_UNPROCESSABLE_ENTITY
            );
    }

    protected function errorHandling(\Throwable $th): JsonResponse
    {
        if ($th instanceof ModelNotFoundException) {
            return response()
                ->json(
                    [
                        'message' => 'Resource Not Found',
                    ],
                    Response::HTTP_NOT_FOUND
                );
        }

        Log::error($th);

        if ($th instanceof AuthorizationException) {
            return response()
                ->json(
                    [
                        'message' => 'Forbidden',
                    ],
                    Response::HTTP_FORBIDDEN
                );
        }

        return response()
            ->json(
                [
                    'message' => 'Something went wrong',
                ],
                Response::HTTP_INTERNAL_SERVER_ERROR
            );
    }
}
