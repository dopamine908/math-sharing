<?php

namespace App\Services;

use App\Models\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class QuestionService
{
    protected QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    /**
     * @param int $id
     * @return Model|Collection|Builder|array
     *
     * @throws ModelNotFoundException
     */
    public function read(int $id): Model|Collection|Builder|array
    {
        $model = $this->questionRepository->find($id);

        if (is_null($model)) {
            throw new ModelNotFoundException();
        }

        return $model;
    }

    /**
     * @param array $data
     * @return Question
     */
    public function create(array $data): Question
    {
        $data = array_merge(
            [
                'users_id' => auth()->user()->id,
            ],
            $data
        );

        return $this->questionRepository->create($data);
    }
}
