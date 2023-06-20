<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * snack case naming convention
     */
    public function test_the_index_page_returns_a_successful_response(): void
    {
        $response = $this->get('/');

        $response->assertStatus(200);
        $response->assertSeeText('Home');
    }

    /**
     * camal case naming convention
     */
    public function testTheContactPageIsWorkingCorrectly(): void
    {
        $response = $this->get('/contact');

        $response->assertStatus(200);
        $response->assertSeeText('Contact');
    }
}
