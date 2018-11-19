<?php

namespace Tests\Feature\Api;

use App\Task;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Gate;
use Tests\TestCase;

class TaskControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function task_manager_can_show_a_task()
    {
        login($this, 'api');
        // TODO add role TaskManager al usuari

        //1
        $task = factory(Task::class)->create();
        // 2
        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean)$result->completed);
    }

    /**
     * @test
     */
    public function superadmin_can_show_a_task()
    {
        $user = login($this, 'api');
        $user->admin = true;
        $user->save();
        //1
        $task = factory(Task::class)->create();
        // 2
        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($task->name, $result->name);
        $this->assertEquals($task->completed, (boolean)$result->completed);
    }

    /**
     * @test
     */
    public function regular_user_cannot_show_a_task()
    {
        login($this, 'api');
        //1
        $task = factory(Task::class)->create();
        // 2
        $response = $this->json('GET', '/api/v1/tasks/' . $task->id);
        // 3
        $result = json_decode($response->getContent());
        $response->assertStatus(403);
    }

    /**
     * @test
     */
    public function can_delete_task()
    {
//        $this->withoutExceptionHandling();
        // 1
        login($this, 'api');
        $task = factory(Task::class)->create();

        // 2
        $response = $this->json('DELETE', '/api/v1/tasks/' . $task->id);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);
//        $this->assertDatabaseMissing('tasks', $task);
        $this->assertNull(Task::find($task->id));
    }

    /**
     * @test
     */
    public function cannot_create_task_without_name()
    {
        // 1
        login($this, 'api');
        // 2
        $response = $this->json('POST', '/api/v1/tasks/', [
            'name' => ''
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function cannot_edit_task_without_name()
    {
        // 1
        login($this, 'api');
        $oldTask = factory(Task::class)->create();
        // 2
        $response = $this->json('PUT', '/api/v1/tasks/' . $oldTask->id, [
            'name' => ''
        ]);

        // 3
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function can_create_task()
    {
//        $this->withoutExceptionHandling();
        $this->markTestSkipped();
        // 1
        $user = login($this, 'api');

        // TODO assign permission to $user

        $user->givePermissionTo('task.store');

//        Gate::define('task.store', function ($user) {
//            dd('PROVA');
//        });

        // 2
        $response = $this->json('POST', '/api/v1/tasks/', [
            'name' => 'Comprar pa'
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        //        $this->assertDatabaseMissing('tasks', $task);
        $this->assertNotNull($task = Task::find($result->id));
        $this->assertEquals('Comprar pa', $result->name);
        $this->assertFalse($result->completed);
    }

    /**
     * @test
     */
    public function can_list_task()
    {
        login($this, 'api');
        create_example_tasks();

        $response = $this->json('GET', '/api/v1/tasks/', [
            'name' => 'Comprar pa'
        ]);
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(3, $result);
        $this->assertEquals('comprar pa', $result[0]->name);
        $this->assertFalse((boolean)$result[0]->completed);

        $this->assertEquals('comprar llet', $result[1]->name);
        $this->assertFalse((boolean)$result[1]->completed);

        $this->assertEquals('Estudiar PHP', $result[2]->name);
        $this->assertTrue((boolean)$result[2]->completed);
    }

    /**
     * @test
     */
    public function can_edit_task()
    {
        // 1
        login($this, 'api');
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet'
        ]);
        // 2
        $response = $this->json('PUT', '/api/v1/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa'
        ]);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals('Comprar pa', $result->name);
        $this->assertFalse((boolean)$newTask->completed);

    }

}