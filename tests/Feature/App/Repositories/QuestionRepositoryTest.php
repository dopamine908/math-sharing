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
