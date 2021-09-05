<?php

namespace App\Services;

use App\Repositories\QuestionRepository;

class QuestionService
{
    protected QuestionRepository $questionRepository;

    public function __construct(QuestionRepository $questionRepository)
    {
        $this->questionRepository = $questionRepository;
    }

    public function read(int $id)
    {
        return $this->questionRepository->find($id);
    }
}
