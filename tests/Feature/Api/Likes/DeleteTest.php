<?php

namespace Tests\Feature\Api\Likes;

use App\Models\Like;
use App\Models\User;
use Tests\Feature\TestCase;

class DeleteTest extends TestCase
{
    /**
     * @test
     */
    public function GivenId_WhenDestroy_ThenReturnDeletedStatusCode()
    {
        //Arrange
        $user = User::factory()->create();
        $like = Like::factory()->create(
            [
                'users_id' => $user->id,
            ]
        );
        $id = $like->id;

        //Act
        $response = $this
            ->be($user)
            ->delete("/api/likes/$id");

        //Assert
        $response->assertNoContent();
    }

    /**
     * @test
     */
    public function GivenNotExistedDeleteId_WhenDestroy_ThenReturnNotFound()
    {
        //Arrange
        $user = User::factory()->create();
        $id = 112;

        //Act
        $response = $this
            ->be($user)
            ->delete("/api/likes/$id");

        //Assert
        $response->assertNotFound();
    }

    /**
     * @test
     */
    public function GivenDeleteIdButNotCreateUser_WhenDestroy_ThenReturnForbidden()
    {
        //Arrange
        $user = User::factory()->create();
        $createUser = User::factory()->create();

        $like = Like::factory()->create(
            [
                'users_id' => $createUser->id,
            ]
        );
        $id = $like->id;

        //Act
        $response = $this
            ->be($user)
            ->delete("/api/likes/$id");

        //Assert
        $response->assertForbidden();
    }
}
