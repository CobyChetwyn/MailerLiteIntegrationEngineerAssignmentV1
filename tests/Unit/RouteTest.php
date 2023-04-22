<?php

namespace Tests\Unit;

use Tests\TestCase;

class RouteTest extends TestCase
{
    /**
     * Base URL should be accessible
     *
     * @return void
     */
    public function test_base_url()
    {
      $response = $this->get('/');

      $response->assertStatus(200);
    }
}
