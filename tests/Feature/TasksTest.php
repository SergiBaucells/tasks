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
    public function can_show_tasks_()
    {
        $this->withoutExceptionHandling();
        // Preparar
        Task::create([
            'name' => 'Comprar pa',
            'completed' => false
        ]);
        Task::create([
            'name' => 'Estudiar PHP',
            'completed' => false
        ]);
        Task::create([
            'name' => 'Comprar llet',
            'completed' => false
        ]);
        // Executar /task
        $response = $this->get('/tasks');
//        dd($response->getContent());

        // Comprovar
        $response->assertSuccessful();
        $response->assertSee('Tasques');
        // Comprovar que es veuen les tasques que hi ha a la base de dades
        $response->assertSee('Comprar pa');
        $response->assertSee('Estudiar PHP');
        $response->assertSee('Comprar llet');

    }

    /**
     * @test
     */
    public function can_store_tack()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/tasks',[
            'name'=>'Comprar patates'
        ]);
//        $response->assertSuccessful();
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks',[
            'name'=>'Comprar patates'
        ]);
    }

    /**
     * @test
     */
    public function can_not_delete_an_unexisting_task()
    {
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_delete_task()
    {
        $this->withoutExceptionHandling();
        // Preparar
        $task = Task::create([
            'name'=>'Comprar pa'
        ]);
        // Executar
        $response = $this->delete('/tasks/' . $task->id);
        //Comprovar
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks',[
            'name'=>'Comprar pa'
        ]);
    }
}
