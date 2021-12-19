<?php

namespace App\Http\Controllers;

use App\Services\LikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;

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
            $request->validate(
                [
                    'resource' => 'required|in:questions',
                    'resource_id' => 'required|integer',
                ],
                [
                    'resource.in' => 'The :attribute field does not exist in: [questions].',
                ]
            );

            $like = $this->likeService->create(
                [
                    'resource' => $request->input('resource'),
                    'resource_id' => $request->input('resource_id'),
                ]
            );

            return response()
                ->json(
                    [
                        'data' => $like,
                    ],
                    Response::HTTP_CREATED
                );
        } catch (ValidationException $exception) {
            return $this->validationExceptionHandling($exception);
        } catch (Throwable $th) {
            return $this->errorHandling($th);
        }
    }
}
