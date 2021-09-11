<?php

namespace App\Repositories;

use App\Models\Question;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

class QuestionRepository
{
    protected Question $model;

    public function __construct(Question $model)
    {
        $this->model = $model;
    }

    public function find(int $id): Model|Collection|Builder|array|null
    {
        return $this->model::query()->find($id);
    }

    public function create(array $data): bool
    {
        /**
         * @var Question $model
         */
        $model = new $this->model();

        $model->description = $data['description'];
        $model->users_id = $data['users_id'];

        return $model->save();
    }
}
