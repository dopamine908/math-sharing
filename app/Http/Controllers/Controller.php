<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller as BaseController;
use Symfony\Component\HttpFoundation\Response;

class Controller extends BaseController
{
    use AuthorizesRequests;
    use DispatchesJobs;
    use ValidatesRequests;

    protected function errorHandling(\Throwable $th): JsonResponse
    {
        //TODO: Write Throwable to log.

        if ($th instanceof ModelNotFoundException) {
            return response()
                ->json([
                           'message' => 'Resource Not Found',
                       ], Response::HTTP_NOT_FOUND);
        }

        return response()
            ->json([
                       'message' => 'Something went wrong',
                   ], Response::HTTP_INTERNAL_SERVER_ERROR);
    }
}
