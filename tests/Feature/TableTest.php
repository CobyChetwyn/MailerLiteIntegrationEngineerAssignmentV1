<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class TableTest extends TestCase
{
    /**
     * Testing for subscriber index.
     *
     * @return void
     */
    public function test_table_get_subscribers()
    {
        $response = $this->get('/subscriber-management');

        $response->assertStatus(200);
    }
}
