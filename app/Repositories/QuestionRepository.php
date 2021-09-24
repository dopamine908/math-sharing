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

    public function create(array $data): Question
    {
        /**
         * @var Question $model
         */
        $model = new $this->model();

        $model->description = $data['description'];
        $model->users_id = $data['users_id'];

        $model->save();

        return $model;
    }

    /**
     * @param int $id
     * @param array $updateData
     * @return Question
     */
    public function update(int $id, array $updateData): Question
    {
        $model = $this->model->find($id);

        foreach ($updateData as $key => $value) {
            $model->$key = $value;
        }

        $model->save();

        return $model;
    }

    /**
     * @param int $id
     */
    public function delete(int $id)
    {
        $this->model::query()
            ->where('id', $id)
            ->delete();
    }
}
