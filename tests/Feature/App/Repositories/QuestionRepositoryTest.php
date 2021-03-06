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

        $id = 2;

        $questions = Question::factory()
            ->create(['id' => $id]);

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

    /**
     * @test
     */
    public function GivenData_WhenCreate_ThenInsertToDatabase()
    {
        //Arrange
        $data = [
            'description' => 'abc',
            'users_id' => 4,
        ];

        $this->sut = app(QuestionRepository::class);

        //Act
        $actual = $this->sut->create($data);

        //Assert
        $this->assertDatabaseHas('questions', $data);
    }

    /**
     * @test
     */
    public function GivenUpdateData_WhenUpdate_ThenUpdateToDatabase()
    {
        //Arrange
        $question = Question::factory()->create(
            [
                'description' => 'original',
            ]
        );

        $updatedData = [
            'description' => 'after updated.',
        ];

        $this->sut = app(QuestionRepository::class);

        //Act
        $this->sut->update($question->id, $updatedData);

        //Assert
        $this->assertDatabaseHas('questions', $updatedData);
    }

    /**
     * @test
     */
    public function GivenId_WhenDelete_ThenDeleteToDatabase()
    {
        //Arrange
        $question = Question::factory()->create();

        $id = $question->id;

        $this->sut = app(QuestionRepository::class);

        //Act
        $this->sut->delete($id);

        //Assert
        $this->assertDatabaseMissing('questions', [
            'id' => $id,
        ]);
    }
}
