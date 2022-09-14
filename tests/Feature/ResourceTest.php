<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    use RefreshDatabase;
    
    
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_fetch_questions_over_api()
    {
        $this->seed();
        $response = $this->getJson('/api/questions');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('data')
                ->missing('message')
        );
    }
    
    public function test_api_response_contains_question()
    {
        $this->seed();
        $response = $this->getJson('/api/questions');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 4)
                ->has('data.0', fn ($json) =>
                $json->has('question')
                    ->has('peak_personality')
                    ->has('anchor_rank')
                    ->whereType('anchor_rank',['double', 'integer', 'float'])
                    ->etc()
            )
        );
    }

    public function test_api_response_questions_contain_answers()
    {
        $this->seed();
        $response = $this->getJson('/api/questions');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('data', 4)
                ->has('data.0', fn ($json) =>
                    $json->has('answers', 4)
                        ->has('answers.0', fn ($json) =>
                            $json->has('answer')
                                ->has('rank')
                                ->whereType('rank', 'integer')
                                ->etc()
                        )
                ->etc()
            )
        );
    }
    public function test_api_response_results_endpoint()
    {
        $this->seed();
        $response = $this->postJson('/api/result');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('message')
            ->where('allowed', false)
            ->etc()
        );
    }
    
}
