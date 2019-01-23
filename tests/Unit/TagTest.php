<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 19/10/18
 * Time: 16:17
 */

namespace Tests\Unit;

use App\Tag;
use App\Task;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class TagTest extends TestCase
{
    use refreshDatabase;

    /**
     * @test
     */
    public function map()
    {
        $task = Tag::create([
            'name' => 'Etiqueta',
            'description' => 'Descripció',
            'color' => '#000000'
        ]);
        $mappedTask = $task->map();
        $this->assertEquals($mappedTask['id'],1);
        $this->assertEquals($mappedTask['name'],'Etiqueta');
        $this->assertEquals($mappedTask['description'],'Descripció');
        $this->assertEquals($mappedTask['color'],'#000000');
    }

    /**
     * @test
     */
    public function can_add_a_task_to_tag()
    {
        // 1 Prepare
        $task = Task::create([
            'name' => 'Comprar pa'
        ]);

        $task2 = Task::create([
            'name' => 'Comprar llet'
        ]);

        $tag = Tag::create([
            'name' => 'home',
            'description' => 'Descripció',
            'color' => '#000000'
        ]);

        // execució
        $tag->addTask($task);

        // Assertion
        $tasks = $tag->tasks;

        $this->assertTrue($tasks[0]->is($task));

        // execució
        $tag->addTask($task2->id);

//        // Assertion
//        $tasks = $tag->tasks;
//
//        $this->assertTrue($tasks[1]->is($task2));

    }

}