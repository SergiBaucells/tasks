<?php

namespace Tests\Feature;

use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksTest extends TestCase
{
    use RefreshDatabase;
    /**
     * @test
     */
    public function todo()
    {
        $this->withoutExceptionHandling();
        // Preparar
        Task::create([
            'name' => 'Comprar pa',
            'completed' => false
        ]);
        // Executar /task
        $response = $this->get('/tasks');
//        dd($response->getContent());

        // Comprovar
        $response->assertSuccessful();
        $response->assertSee('Tasques');
        // Comprovar que es veuen les tasques que hi ha a la base de dades

    }
}
