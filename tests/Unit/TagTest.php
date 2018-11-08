<?php
/**
 * Created by PhpStorm.
 * User: sergi
 * Date: 19/10/18
 * Time: 16:17
 */

namespace Tests\Unit;

use App\Tag;
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

}