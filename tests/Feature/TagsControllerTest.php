<?php

// PSR-4
namespace Tests\Feature;

use App\Tag;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TagsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    /**
     * @test
     */
    public function guest_user_cannot_show_tags()
    {
        // 2 execute
        $response = $this->get('/tags');

        //3 Comprovar
        $response->assertRedirect('/login');

        // Comprovar que es veuen les etiquetes que hi ha a la base dades

    }

    /**
     * @test
     */
    public function regular_user_cannot_show_tags()
    {
        //1 Prepare
        login($this);
        // 2 execute
        $response = $this->get('/tags');

        //3 Comprovar
        $response->assertStatus(403);

    }

    /**
     * @test
     */
    public function superadmin_can_show_tags()
    {
        //1 Prepare
        $this->loginAsSuperAdmin();
        create_example_tags();
        // 2 execute
        $response = $this->get('/tags');

        //3 Comprovar
        $response->assertSuccessful();
        $response->assertViewIs('tags');
        $response->assertViewHas('tags', function ($tags) {
            return count($tags) === 3 &&
                $tags[0]['name'] === 'Etiqueta 1' &&
                $tags[1]['name'] === 'Etiqueta 2' &&
                $tags[2]['name'] === 'Etiqueta 3';
        });

        // Comprovar que es veuen les etiquetes que hi ha a la base dades

    }

    /**
     * @test
     */
    public function tags_manager_can_show_tags()
    {
        //1 Prepare
        $this->loginAsTaskManager();
        // 2 execute
        $response = $this->get('/tags');

        //3 Comprovar
        $response->assertSuccessful();
        $response->assertSee('Tags');

        $response->assertSee('Etiqueta 1');
        $response->assertSee('Etiqueta 2');
        $response->assertSee('Etiqueta 3');

        // Comprovar que es veuen les etiquetes que hi ha a la base dades

    }

    /**
     * @test
     */
    public function users_with_roles_cannot_show_tags()
    {
        //1 Prepare
        create_example_tags();
        login($this);
        // 2 execute
        $response = $this->get('/tags');

        //3 Comprovar
        $response->assertSuccessful();
        $response->assertSee('Tags');

        $response->assertSee('Etiqueta 1');
        $response->assertSee('Etiqueta 2');
        $response->assertSee('Etiqueta 3');

        // Comprovar que es veuen les etiquetes que hi ha a la base dades

    }
}
