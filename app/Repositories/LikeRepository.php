<?php

namespace App\Repositories;

use App\Models\Like;

class LikeRepository
{
    public Like $model;

    public function __construct(Like $model)
    {
        $this->model = $model;
    }

    public function create(array $data): Like
    {
        /**
         * @var Like $model
         */
        $model = new $this->model();

        $model->resource = $data['resource'];
        $model->resource_id = $data['resource_id'];
        $model->users_id = $data['users_id'];

        $model->save();

        return $model;
    }

    public function delete(int $id): bool
    {
        /**
         * @var Like $like
         */
        $like = $this->model->find($id);

        $like->delete();

        return true;
    }

    public function findOrFail(int $id): ?Like
    {
        /**
         * @var ?Like $model
         */
        $model = $this->model::query()->find($id);

        return $model;
    }
}
