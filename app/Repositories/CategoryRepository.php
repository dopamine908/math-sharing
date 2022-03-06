<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository
{
    protected Category $model;

    public function __construct(Category $model)
    {
        $this->model = $model;
    }

    /**
     * 新增文章分類
     *
     * @param array $data
     * @return Category
     */
    public function create(array $data): Category
    {
        $model = new $this->model();

        $model->name = $data['name'];
        $model->parent_id = $data['parent_id'] ?? null;

        $model->save();

        return $model;
    }
}
