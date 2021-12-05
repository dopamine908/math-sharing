<?php

namespace Tests\Feature\App\Repositories;

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
}
