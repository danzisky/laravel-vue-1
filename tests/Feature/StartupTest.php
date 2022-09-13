<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class StartupTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_dashboard_is_accessible()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_test_page_is_accessible()
    {
        $response = $this->get('/test');

        $response->assertStatus(200);
    }
}
