<?php

namespace Tests\Feature;

use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ClockControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;


    /**
     * @test
     */
    public function todo()
    {
        $this->login('web');

        $response = $this->get('/clock');

        $response->assertSuccessful();
        $response->assertViewIs('clock.index');
    }



}
