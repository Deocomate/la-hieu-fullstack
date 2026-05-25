<?php

namespace Tests\Feature;

use App\Models\Page;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic test example.
     */
    public function test_the_application_returns_a_successful_response(): void
    {
        Page::factory()->create([
            'key' => 'home',
            'title' => 'Home',
            'hero_images' => [],
            'content' => [],
        ]);

        $response = $this->get('/');

        $response->assertStatus(200);
    }
}
