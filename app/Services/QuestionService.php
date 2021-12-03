<?php

namespace App\Services;

use App\Models\Question;
use App\Repositories\QuestionRepository;
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
     * @return Question
     */
    public function read(int $id): Question
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
                'users_id' => auth()->user()->id ?? 0,
            ],
            $data
        );

        return $this->questionRepository->create($data);
    }

    /**
     * @param int $id
     * @param array $data
     * @return Question
     */
    public function update(int $id, array $data): Question
    {
        return $this->questionRepository->update($id, $data);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function delete(int $id): bool
    {
        $this->questionRepository->delete($id);

        return true;
    }
}
