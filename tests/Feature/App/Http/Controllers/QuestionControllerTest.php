<?php

namespace Tests\Feature\App\Http\Controllers;

use App\Http\Controllers\QuestionController;
use App\Models\Question;
use Illuminate\Http\Request;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\Feature\TestCase;

class QuestionControllerTest extends TestCase
{
    /**
     * @var QuestionController $sut
     */
    protected QuestionController $sut;

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
}
