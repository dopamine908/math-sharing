<?php

namespace App\Http\Controllers;

use App\Services\LikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LikeController extends Controller
{
    protected LikeService $likeService;

    public function __construct(LikeService $likeService)
    {
        $this->likeService = $likeService;
    }

    public function store(Request $request): JsonResponse
    {
        try {
            //code...
            $resource = $request->input('resource');
            $resourceId = $request->input('resource_id');

            $like = [
                'resource' => $resource,
                'resource_id' => $resourceId,
            ];

            return response()
                ->json(
                    [
                        'data' => $like,
                    ],
                    Response::HTTP_CREATED
                );
        } catch (\Throwable $th) {
            dump($th);

            return $this->errorHandling($th);
        }
    }
}
