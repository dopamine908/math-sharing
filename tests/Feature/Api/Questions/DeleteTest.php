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
        $question = Question::factory()->create();
        $user = User::factory()->bear()->create();
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
}
