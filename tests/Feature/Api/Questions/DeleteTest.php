<?php

namespace Tests\Feature\Api\Questions;

use App\Models\Question;
use App\Models\User;
use Tests\Feature\TestCase;

class DeleteTest extends TestCase
{
    /**
     * @test
     */
    public function GivenDeleteId_WhenDestroy_ThenReturnDeletedStatusCode()
    {
        //Arrange
        $user = User::factory()->bear()->create();
        $question = Question::factory()->create(
            [
                'users_id' => $user->id,
            ]
        );
        $id = $question->id;

        //Act
        $response = $this
            ->be($user)
            ->delete("/api/questions/$id");

        //Assert
        $response->assertNoContent();
    }

    /**
     * @test
     */
    public function GivenNotExistedDeleteId_WhenDestroy_ThenReturnNotFound()
    {
        //Arrange
        $user = User::factory()->bear()->create();
        $id = 112;

        //Act
        $response = $this
            ->be($user)
            ->delete("/api/questions/$id");

        //Assert
        $response->assertNotFound();
    }

    /**
     * @test
     */
    public function GivenDeleteIdButNotCreateUser_WhenDestroy_ThenReturnForbidden()
    {
        //Arrange
        $user = User::factory()->bear()->create();
        $createUser = User::factory()->create();

        $question = Question::factory()->create(
            [
                'users_id' => $createUser->id,
            ]
        );
        $id = $question->id;

        //Act
        $response = $this
            ->be($user)
            ->delete("/api/questions/$id");

        //Assert
        $response->assertForbidden();
    }
}
