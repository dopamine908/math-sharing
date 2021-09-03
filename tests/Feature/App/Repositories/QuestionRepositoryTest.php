<?php

namespace Tests\Feature\App\Repositories;

use App\Models\Question;
use App\Repositories\QuestionRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuestionRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected QuestionRepository $sut;

    /**
     * @test
     *
     * @todo 也許這種測試就別寫了，徒增每次的執行時間
     */
    public function GivenQuestionId_WhenFind_ThenReturnModelWithId()
    {
        //Arrange

        /**
         * @var QuestionRepository
         */
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
}
