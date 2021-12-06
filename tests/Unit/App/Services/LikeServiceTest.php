<?php

namespace Tests\Unit\App\Services;

use App\Models\Like;
use App\Models\User;
use App\Repositories\LikeRepository;
use App\Services\LikeService;
use Tests\TestCase;

class LikeServiceTest extends TestCase
{
    /**
     * @var LikeService $sut
     */
    protected LikeService $sut;

    /**
     * @test
     */
    public function GivenRequest_WhenCreate_ThenCallRepository()
    {
        //Arrange
        $user = User::factory()->make();
        $this->actingAs($user);

        $spyLikeRepository = $this->spy(LikeRepository::class);

        $this->sut = app(LikeService::class);

        $data = [
            'resource' => 'questions',
            'resource_id' => 1,
        ];

        //Act
        $this->sut->create($data);

        //Assert
        $spyLikeRepository->shouldHaveReceived('create')
            ->once()
            ->with(
                [
                    'resource' => $data['resource'],
                    'resource_id' => $data['resource_id'],
                    'users_id' => $user->id,
                ]
            );
    }

    /**
     * @test
     */
    public function GivenRequest_WhenDelete_ThenCallRepository()
    {
        //Arrange
        $user = User::factory()->make();
        $this->actingAs($user);

        $spyLikeRepository = $this->spy(LikeRepository::class);

        $this->sut = app(LikeService::class);

        $likeId = 1;

        //Act
        $this->sut->delete($likeId);

        //Assert
        $spyLikeRepository->shouldHaveReceived('delete')
            ->once()
            ->with($likeId);
    }
}
