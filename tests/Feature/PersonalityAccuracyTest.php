<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Testing\Fluent\AssertableJson;
use Tests\TestCase;

class PersonalityAccuracyTest extends TestCase
{
    use RefreshDatabase;
    public $extrovertAnswers = [
        [
            'question_id' => 1,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 4,
        ],
        [
            'question_id' => 2,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 4,
        ],
        [
            'question_id' => 3,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 4,
        ],
        [
            'question_id' => 4,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 4,
        ],

    ];
    public $introvertAnswers = [
        [
            'question_id' => 1,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 1,
        ],
        [
            'question_id' => 2,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 1,
        ],
        [
            'question_id' => 3,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 1,
        ],
        [
            'question_id' => 1,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 1,
        ],

    ];
    public $ambivertAnswers = [
        [
            'question_id' => 1,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 1,
        ],
        [
            'question_id' => 2,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 2,
        ],
        [
            'question_id' => 3,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 3,
        ],
        [
            'question_id' => 1,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 4,
        ],

    ];
    public $ambivertAnswers2 = [
        [
            'question_id' => 1,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 1,
        ],
        [
            'question_id' => 2,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 1,
        ],
        [
            'question_id' => 3,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 4,
        ],
        [
            'question_id' => 1,
            'anchor_rank' => 2.01,
            'peak_personality' => 'extrovert',
            'answer_id' => null,
            'answer_rank' => 4,
        ],

    ];
    /**
     * A basic feature test example.
     *
     * @return void
     */

    public function test_successful_results_fetch_with_data()
    {
        $response = $this->postJson('/api/result', ['testResponse' => $this->introvertAnswers]);

        $response->assertStatus(200);
    }
    
    public function test_returns_pure_extrovert_example()
    {


        $this->seed();
        $response = $this->postJson('/api/result', ['testResponse' => $this->extrovertAnswers]);

        
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('netScore')
            ->where('extrovertScore', 1)
            ->where('totalScoreExtrovert', 16)
            ->where('introvertScore', 0)
            ->where('totalScoreIntrovert', 0)
            ->etc()
        );
    }

    public function test_returns_pure_introvert_example()
    {


        $this->seed();
        $response = $this->postJson('/api/result', ['testResponse' => $this->introvertAnswers]);

        
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('netScore')
            ->where('extrovertScore', 0)
            ->where('totalScoreExtrovert', 0)
            ->where('introvertScore', 1)
            ->where('totalScoreIntrovert', 16)
            ->etc()
        );
    }

    public function test_returns_ambivert_example_1()
    {


        $this->seed();
        $response = $this->postJson('/api/result', ['testResponse' => $this->ambivertAnswers]);

        
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('netScore')
            ->where('extrovertScore', 0.5)
            ->where('totalScoreExtrovert', 8)
            ->where('introvertScore', 0.5)
            ->where('totalScoreIntrovert', 8)
            ->etc()
        );
    }
    public function test_returns_ambivert_example_2()
    {


        $this->seed();
        $response = $this->postJson('/api/result', ['testResponse' => $this->ambivertAnswers2]);

        
        $response->assertJson(fn (AssertableJson $json) =>
            $json->has('netScore')
            ->where('extrovertScore', 0.5)
            ->where('totalScoreExtrovert', 8)
            ->where('introvertScore', 0.5)
            ->where('totalScoreIntrovert', 8)
            ->etc()
        );
    }
}
