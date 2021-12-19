<?php

namespace App\Http\Controllers;

use App\Services\LikeService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
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
        } catch (Throwable $th) {
            return $this->errorHandling($th);
        }
    }

    public function destroy(Request $request, int $id): JsonResponse
    {
        try {
            $like = $this->likeService->findOrFail($id);
            $this->authorize('delete', $like);

            $this->likeService->delete($id);

            return response()->json(
                [],
                Response::HTTP_NO_CONTENT
            );
        } catch (\Throwable $th) {
            return $this->errorHandling($th);
        }
    }
}
