<?php

namespace Tests\Feature\Api;


use App\Events\TaskUpdate;
use App\Task;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Event;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;


class LoggedUserTasksControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function can_list_logged_user_tasks()
    {
        // 1
        initialize_roles();
        $user = login($this, 'api');
        $user->assignRole('Tasks');

        $task1 = factory(Task::class)->create();
        $task2 = factory(Task::class)->create();
        $task3 = factory(Task::class)->create();

        $tasks = [$task1, $task2, $task3];
        $user->addTasks($tasks);

        // 2 execute
        $response = $this->json('GET', '/api/v1/user/tasks');
        $response->assertSuccessful();

        $result = json_decode($response->getContent());

        $this->assertCount(3, $result);
        $this->assertEquals($result[0]->id,$task1->id);
        $this->assertEquals($result[1]->id,$task2->id);
        $this->assertEquals($result[2]->id,$task3->id);
    }

    /**
     * @test
     */
    public function can_not_list_logged_user_tasks_if_user_is_not_logged()
    {
//        $this->markTestSkipped();
        // 2
        $response = $this->json('GET', '/user/tasks');
        $response->assertStatus(401);
    }

    /**
     * @test
     */
    public function can_edit_task()
    {
//        $this->withoutExceptionHandling();
        // 1
        initialize_roles();
        $user = $this->loginAsTasksUser('api');
        Event::fake();
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'Bla bla bla'
        ]);
        $user->addTask($oldTask);
        // 2
        $response = $this->json('PUT','/api/v1/user/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa',
            'description' => 'JORl jhorlsad asd'
        ]);
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $newTask = $oldTask->refresh();
        $this->assertNotNull($newTask);
        $this->assertEquals($oldTask->id,$result->id);
        $this->assertEquals('Comprar pa',$result->name);
        $this->assertEquals('JORl jhorlsad asd',$result->description);
        $this->assertFalse((boolean) $newTask->completed);
        Event::assertDispatched(TaskUpdate::class, function ($event) use ($newTask) {
            return $event->task->is($newTask);
        });

    }

    /**
     * @test
     */
    public function can_not_edit_a_task_not_associated_to_user()
    {
        // 1
        initialize_roles();
        $user = login($this, 'api');
        $user->assignRole('Tasks');
        $oldTask = factory(Task::class)->create([
            'name' => 'Comprar llet'
        ]);
        // 2
        $response = $this->json('PUT', '/api/v1/user/tasks/' . $oldTask->id, [
            'name' => 'Comprar pa'
        ]);
        // 3
        $response->assertStatus(404);

    }

    /**
     * @test
     */
    public function can_delete_tasks()
    {
        initialize_roles();
        $user = login($this, 'api');
        $user->assignRole('Tasks');

        $task = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'Bla bla bla'
        ]);

        $user->addTask($task);
        $response = $this->json('DELETE','/api/v1/user/tasks/' . $task->id);

        $response -> assertSuccessful();
        $this->assertCount(0,$user->tasks);
        $task = $task->fresh();
        $this->assertNull($task);
    }

    /**
     * @test
     */
    public function cannot_delete_not_owned_tasks()
    {
        initialize_roles();
        $user = login($this, 'api');
        $user->assignRole('Tasks');

        $task = factory(Task::class)->create([
            'name' => 'Comprar llet',
            'description' => 'Bla bla bla'
        ]);

        $response = $this->json('DELETE','/api/v1/user/tasks/' . $task->id);

        $response -> assertStatus(404);
    }
}