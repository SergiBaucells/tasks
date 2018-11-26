<?php

// PSR-4
namespace Tests\Feature;

use App\Tag;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function can_show_tags()
    {
        $this->withoutExceptionHandling();

        //1 Prepare
        create_example_tags();
        login($this);

//        dd(Tag::find(1));

        // 2 execute
        $response = $this->get('/tags');
//        dd($response->getContent());

        //3 Comprovar
        $response->assertSuccessful();
        $response->assertSee('Tags');

        $response->assertSee('Etiqueta 1');
        $response->assertSee('Etiqueta 2');
        $response->assertSee('Etiqueta 3');

        // Comprovar que es veuen les etiquetes que hi ha a la base dades

    }
}
