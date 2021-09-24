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

            //TODO: use transformer to hide some information.
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

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(Request $request, int $id): JsonResponse
    {
        try {
            $question = $this->questionService->read($id);
            $this->authorize('update', $question);

            $updateData = $request->get('data');
            $question = $this->questionService->update($id, $updateData);

            return response()->json(
                [
                    'data' => $question,
                ]
            );
        } catch (\Throwable $th) {
            return $this->errorHandling($th);
        }
    }

    /**
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function destroy(Request $request, int $id): JsonResponse
    {
        try {
            $question = $this->questionService->read($id);
            $this->authorize('delete', $question);

            $this->questionService->delete($id);

            return response()->json(
                [],
                Response::HTTP_NO_CONTENT
            );
        } catch (\Throwable $th) {
            return $this->errorHandling($th);
        }
    }
}
