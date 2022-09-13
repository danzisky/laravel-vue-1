<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class ResourceTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_can_fetch_questions_over_api()
    {
        $response = $this->getJson('/api/questions');

        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('data')
                ->missing('message')
        );
    }
}
