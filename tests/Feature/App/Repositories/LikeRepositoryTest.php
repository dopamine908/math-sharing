<?php

namespace Tests\Feature\App\Repositories;

use App\Models\Like;
use App\Repositories\LikeRepository;
use Tests\Feature\TestCase;

class LikeRepositoryTest extends TestCase
{
    /**
     * @var LikeRepository $sut
     */
    protected LikeRepository $sut;

    /**
     * @test
     */
    public function GivenData_WhenCreate_ThenInsertToDatabase()
    {
        //Arrange
        $data = [
            'resource' => 'question',
            'resource_id' => 1,
            'users_id' => 4,
        ];

        $this->sut = app(LikeRepository::class);

        //Act
        $actual = $this->sut->create($data);

        //Assert
        $this->assertDatabaseHas('likes', $data);
    }

    /**
     * @test
     */
    public function GivenId_WhenDelete_ThenDeleteDatabaseData()
    {
        //Arrange
        $like = Like::factory()->create();
        $id = $like->id;

        $this->sut = app(LikeRepository::class);

        //Act
        $this->sut->delete($id);

        //Assert
        $this->assertDatabaseMissing('likes', [
            'id' => $id,
        ]);
    }

    /**
     * @test
     */
    public function GivenExistId_WhenFindOrFail_ThenReturnModel()
    {
        //Arrange
        $this->sut = app(LikeRepository::class);

        $id = 2;

        $questions = Like::factory()
            ->create(['id' => $id]);

        //Act
        $actual = $this->sut->findOrFail($id);

        //Assert
        $this->assertEquals($actual->id, $id);
    }
}
