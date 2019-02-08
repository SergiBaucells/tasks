<?php

// PSR-4
namespace Tests\Feature;

use App\Task;
use App\User;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Support\Facades\Cache;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TasksControllerTest extends TestCase
{
    use RefreshDatabase;

//    use WithoutMiddleware;

    /**
     * @test
     */
    public function can_show_tasks()
    {
        $this->withoutExceptionHandling();
        //1 Prepare
        create_example_tasks();
        login($this);

        // Si el que executem acaba executanr altres caches -> PETARÀ
        // 2 execute
        // TODO
//        Cache::shouldReceive('remember')
//            ->once()
//            ->with('git_info', 5, \Closure::class)
//            ->andReturn([collect([])]);
//        Cache::shouldReceive('rememberForever')
//            ->once()
//            ->with(Task::TASKS_CACHE_KEY, \Closure::class)
//            ->andReturn(map_collection(Task::orderBy('created_at', 'desc')->get()));
        $response = $this->get('/tasks');
        //3 Comprovar
        $response->assertSuccessful();
        $response->assertSee('Tasques');
        $response->assertSee('comprar pa');
        $response->assertSee('comprar llet');
        $response->assertSee('Estudiar PHP');

    }

    /**
     * @test
     */
    public function can_store_task()
    {
        login($this);
        $response = $this->post('/tasks', [
            'name' => 'Comprar llet'
        ]);
        $response->assertStatus(302);
        $this->assertDatabaseHas('tasks', ['name' => 'Comprar llet']);
    }

    /**
     * @test
     */
    public function cannnot_delete_an_unexisting_task()
    {
        login($this);
        $response = $this->delete('/tasks/1');
        $response->assertStatus(404);
    }

    /**
     * @test
     */
//    public function user_without_permissions_cannnot_delete_tasks()
//    {
//        $response = $this->delete('/tasks/1');
//        $response->assertStatus(403);
//    }


    /**
     * @test
     */
    public function can_delete_task()
    {
//        $this->withoutExceptionHandling();
        login($this);

        // 1
        $task = Task::create([
            'name' => 'Comprar llet'
        ]);

        // 2
        $response = $this->delete('/tasks/' . $task->id);

        // 3
        $response->assertStatus(302);
        $this->assertDatabaseMissing('tasks', ['name' => 'Comprar llet']);

    }

    /**
     * @test
     */
    public function can_edit_a_task()
    {
        // 1
        login($this);
        $task = Task::create([
            'name' => 'asdasdasd',
            'completed' => '0'
        ]);
        //2
        $response = $this->put('/tasks/' . $task->id, $newTask = [
            'name' => 'Comprar pa',
            'completed' => '1'
        ]);
        $response->assertStatus(302);
//            $response->assertStatus(200);
        // 2 opcions
//        $this->assertDatabaseHas('tasks',$newTask);
//        $this->assertDatabaseMissing('tasks',$task);
        $task = $task->fresh();
        $this->assertEquals($task->name, $newTask['name']);
        $this->assertEquals($task->completed, $newTask['completed']);
    }

    /**
     * @test
     */
    public function cannot_edit_an_unexisting_task()
    {
//        $this->withoutExceptionHandling();
        // TDD Test Driven Development ->
        login($this);
        // 2 execute HTTP REQUEST -> HTTP RESPONSE (resposta)
        $response = $this->put('/tasks/1', []);
//        dd($response->getContent());
        // 3 assert
        $response->assertStatus(404);
    }

    /**
     * @test
     */
    public function can_show_edit_form()
    {
        // 1
        login($this);
        $task = Task::create([
            'name' => 'Comprar pa',
            'completed' => false
        ]);
        $response = $this->get('/task_edit/' . $task->id);
        $response->assertSuccessful();

        $response->assertSee('Comprar pa');
    }

    /**
     * @test
     */
    public function cannot_show_edit_form_unexisting_task()
    {
//        $this->withoutExceptionHandling();
        login($this);
        $response = $this->get('/task_edit/1');
        $response->assertStatus(404);
    }
}
