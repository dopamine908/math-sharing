<?php

namespace Tests\Unit\App\Services;

use App\Models\Question;
use App\Models\User;
use App\Repositories\QuestionRepository;
use App\Services\QuestionService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Tests\TestCase;

class QuestionServiceTest extends TestCase
{
    /**
     * @var QuestionService $sut
     */
    protected QuestionService $sut;

    /**
     * @test
     */
    public function GivenExistedQuestion_WhenRead_ThenReturnModel()
    {
        //Arrange
        $model = Question::factory()
            ->make();

        $stubQuestionRepository = $this->createStubToContainer(QuestionRepository::class);
        $stubQuestionRepository->shouldReceive('find')->andReturn($model);

        $this->sut = $this->app->make(QuestionService::class);

        //Act
        $actual = $this->sut->read(1);

        //Assert
        $this->assertInstanceOf(Question::class, $actual);
    }

    /**
     * @test
     */
    public function GivenNotExistedQuestion_WhenRead_ThenThrowNotFoundException()
    {
        //Arrange
        $stubQuestionRepository = $this->createStubToContainer(QuestionRepository::class);
        $stubQuestionRepository->shouldReceive('find')->andReturn(null);

        $this->sut = $this->app->make(QuestionService::class);

        //Assert
        $this->expectException(ModelNotFoundException::class);

        //Act
        $actual = $this->sut->read(1);
    }

    /**
     * @test
     */
    public function GivenData_WhenCreate_ThenCallRepository()
    {
        //Arrange
        $userId = 4;
        $user = User::factory()->make(['id' => $userId]);
        $this->actingAs($user);

        $spyQuestionRepository = $this->spy(QuestionRepository::class);
        $data = [
            'description' => 'abc',
            'users_id' => $userId,
        ];

        $this->sut = $this->app->make(QuestionService::class);

        //Act
        $this->sut->create($data);

        //Assert
        $spyQuestionRepository->shouldHaveReceived('create')
            ->once()
            ->with($data);
    }
}
