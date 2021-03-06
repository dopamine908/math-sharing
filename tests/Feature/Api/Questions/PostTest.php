<?php

namespace Tests\Feature\Api\Questions;

use App\Models\User;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\TestCase;

class PostTest extends TestCase
{
    /**
     * @test
     */
    public function GivenData_WhenStore_ThenReturnCreated()
    {
        //Arrange
        $user = User::factory()->create();

        $description = 'testing';

        //Act
        $response = $this
            ->be($user)
            ->post("/api/questions", [
                'description' => $description,
            ]);

        //Assert
        $response->assertCreated();
        $response
            ->assertJson(
                function (AssertableJson $json) use ($description) {
                    return $json->where('data.description', $description)
                        ->etc();
                }
            );
    }
}
