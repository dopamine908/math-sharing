<?php

namespace Tests\Feature\Api\Questions;

use App\Models\Question;
use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\TestCase;

class PatchTest extends TestCase
{
    /**
     * @test
     */
    public function GivenUpdateData_WhenUpdate_ThenReturnUpdateResult()
    {
        //Arrange
        $user = User::factory()->create();

        $question = Question::factory()->create(
            [
                'description' => 'original',
                'users_id' => $user->id,
            ]
        );

        $expected = 'after updated.';

        //Act
        $response = $this
            ->be($user)
            ->patch("/api/questions/{$question->id}", [
                'description' => $expected,
            ]);

        //Assert
        $response->assertOk();
        $response
            ->assertJson(
                function (AssertableJson $json) use ($expected) {
                    return $json->where('data.description', $expected)
                        ->etc();
                }
            );
    }

    /**
     * @test
     */
    public function GivenNotExistId_WhenUpdate_ThenReturnNotFound()
    {
        //Arrange
        $id = 1;
        $anyUser = User::factory()->create();

        //Act
        $response = $this
            ->be($anyUser)
            ->patch("/api/questions/$id", [
                'data' => [],
            ]);

        //Assert
        $response->assertNotFound();
    }

    /**
     * @test
     */
    public function GivenUpdateDataButNotCreateUser_WhenUpdate_ThenReturnForbidden()
    {
        //Arrange
        $createUser = User::factory()->create();
        $notCreateUser = User::factory()->create();
        $question = Question::factory()->create(
            [
                'users_id' => $createUser->id,
            ]
        );

        //Act
        $response = $this
            ->be($notCreateUser)
            ->patch("/api/questions/{$question->id}", [
                'data' => [],
            ]);

        //Assert
        $response->assertForbidden();
    }
}
