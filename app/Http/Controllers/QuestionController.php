<?php

namespace App\Http\Controllers;

use App\Services\QuestionService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class QuestionController extends Controller
{
    protected QuestionService $questionService;

    public function __construct(QuestionService $questionService)
    {
        $this->questionService = $questionService;
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function show(Request $request, int $id): JsonResponse
    {
        try {
            $data = $this->questionService->read($id);

            return response()
                ->json([
                           'data' => $data,
                       ]);
        } catch (\Throwable $th) {
            return $this->errorHandling($th);
        }
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        try {
            $question = $this->questionService->create(
                [
                    'description' => $request->get('description'),
                ]
            );

            return response()->json(
                [
                    'data' => $question,
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            return $this->errorHandling($th);
        }
    }
}
