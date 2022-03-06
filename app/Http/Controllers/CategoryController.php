<?php

namespace App\Http\Controllers;

use App\Http\Requests\categoryRequest;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Symfony\Component\HttpFoundation\Response;

class CategoryController extends Controller
{
    protected CategoryService $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }

    /**
     * 新增文章分類
     *
     * @param categoryRequest $request
     * @return JsonResponse
     */
    public function store(categoryRequest $request): JsonResponse
    {
        try {
            $category = $this->categoryService->create(
                [
                    'name' => $request->get('name'),
                    'parent_id' => $request->get('parent_id') ?? null
                ]
            );

            return response()->json(
                [
                    'data' => $category,
                ],
                Response::HTTP_CREATED
            );
        } catch (\Throwable $th) {
            return $this->errorHandling($th);
        }
    }
}
