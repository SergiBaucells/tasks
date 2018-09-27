<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    /**
     * @test
     */
    public function todo()
    {
        // Preparar

        // Executar /task
        $this->get('/tasks');
        // Comprovar
    }
}
