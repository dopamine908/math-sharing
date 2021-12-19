<?php

namespace Tests\Feature\Api\Likes;

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

        $resource = 'questions';
        $resourceId = 1;

        //Act
        $response = $this
            ->be($user)
            ->post("/api/likes", [
                'resource' => $resource,
                'resource_id' => $resourceId,
            ]);

        //Assert
        $response->assertCreated();
        $response
            ->assertJson(
                function (AssertableJson $json) use ($resource, $resourceId) {
                    return $json->where('data.resource', $resource)
                        ->where('data.resource_id', $resourceId)
                        ->etc();
                }
            );
    }
}
