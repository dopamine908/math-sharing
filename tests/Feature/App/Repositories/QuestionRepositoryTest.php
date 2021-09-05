<?php

namespace Tests\Feature\App\Repositories;

use App\Models\Question;
use App\Repositories\QuestionRepository;
use Tests\Feature\TestCase;

class QuestionRepositoryTest extends TestCase
{
    protected QuestionRepository $sut;

    /**
     * @test
     *
     * @todo 也許這種測試就別寫了，徒增每次的執行時間
     */
    public function GivenQuestionId_WhenFind_ThenReturnModelWithId()
    {
        //Arrange
        $this->sut = app(QuestionRepository::class);

        $questions = Question::factory()
            ->count(3)
            ->create();

        $id = 2;

        //Act
        $actual = $this->sut->find($id);

        //Assert
        $this->assertEquals($actual->id, $id);
    }

    /**
     * @test
     *
     * @todo 也許這種測試就別寫了，徒增每次的執行時間
     */
    public function GivenQuestionId_WhenNotFound_ThenReturnNull()
    {
        //Arrange
        $this->sut = app(QuestionRepository::class);

        $id = 2;

        //Act
        $actual = $this->sut->find($id);

        //Assert
        $this->assertNull($actual);
    }
}