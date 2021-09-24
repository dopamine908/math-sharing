<?php

namespace Tests\Feature\Api\Questions;

use App\Models\Question;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\TestCase;

class GetTest extends TestCase
{
    /**
     * @test
     */
    public function GivenExistsId_WhenShow_ThenReturnOK()
    {
        //Arrange
        $id = 1;
        $data = Question::factory()->create(['id' => $id]);

        //Act
        $response = $this->get("/api/questions/$id");

        //Assert
        $response->assertOk();
        $response
            ->assertJson(
                function (AssertableJson $json) use ($id) {
                    return $json->where('data.id', 1)
                        ->etc();
                }
            );
    }

    /**
     * @test
     */
    public function GivenNotExistsId_WhenShow_ThenReturnNotFound()
    {
        //Arrange
        $id = 1;

        //Act
        $response = $this->get("/api/questions/$id");

        //Assert
        $response->assertNotFound();
    }
}
