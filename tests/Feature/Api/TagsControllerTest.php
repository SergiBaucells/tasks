<?php

namespace Tests\Feature\Api;

use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Feature\Traits\CanLogin;
use Tests\TestCase;

class TagsControllerTest extends TestCase
{
    use RefreshDatabase, CanLogin;

    // CRUD -> CRU -> CREATE RETRIEVE UPDATE DELETE
    // BREAD -> PA -> BROWSE READ EDIT ADD DELETE
    // FIELDS
    // name, description, color: #111111
    /**
     * @test
     */
    public function can_show_a_tag()
    {
//        $this->withoutExceptionHandling();
        // routes/api.php
        // http:// tags.test/api/v1/tags
        // HTTP -> GET | POST | PUT | DELETE
        $this->loginAsTagsManager('api');
        //1
        // Tag:create()
        $tag = factory(Tag::class)->create();

        // 2
        $response = $this->json('GET', '/api/v1/tags/' . $tag->id);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals($tag->name, $result->name);
        $this->assertEquals($tag->description, $result->description);
        $this->assertEquals($tag->color, $result->color);
    }

    /**
     * @test
     */
    public function can_delete_tag()
    {
//        $this->withoutExceptionHandling();
        // 1
        $this->loginAsTagsManager('api');
        $tag = factory(Tag::class)->create();

        // 2
        $response = $this->json('DELETE', '/api/v1/tags/' . $tag->id);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $this->assertEquals('', $result);
//        $this->assertDatabaseMissing('tags', $tag);
//        dd(Tag::find($tag->id));
        $this->assertNull(Tag::find($tag->id));
    }

    /**
     * @test
     */
    public function cannot_create_tag_without_name()
    {
//        $this->withoutExceptionHandling();
        // 1
        $this->loginAsTagsManager('api');
        // 2
        $response = $this->json('POST', '/api/v1/tags/', [
            'name' => ''
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function cannot_edit_tag_without_name()
    {
//        $this->withoutExceptionHandling();
        // 1
        $this->loginAsTagsManager('api');
        $oldTag = factory(Tag::class)->create();
        // 2
        $response = $this->json('PUT', '/api/v1/tags/' . $oldTag->id, [
            'name' => ''
        ]);

        // 3
        $response->assertStatus(422);

    }

    /**
     * @test
     */
    public function can_create_tag()
    {
//        $this->withoutExceptionHandling();
        // 1
        $this->loginAsTagsManager('api');
        // 2
        $response = $this->json('POST', '/api/v1/tags/', [
            'name' => 'Etiqueta 1',
            'description' => 'Descripció',
            'color' => '#000000'
        ]);

        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();

        //        $this->assertDatabaseMissing('tags', $tag);
        $this->assertNotNull($tag = Tag::find($result->id));
        $this->assertEquals('Etiqueta 1', $result->name);
        $this->assertEquals('Descripció', $result->description);
        $this->assertEquals('#000000', $result->color);
    }

    /**
     * @test
     */
    public function can_list_tag()
    {
        $this->loginAsTagsManager('api');
        create_example_tags();

        $response = $this->json('GET', '/api/v1/tags/', [
            'name' => 'Etiqueta 1'
        ]);
        $response->assertSuccessful();
        $result = json_decode($response->getContent());
        $this->assertCount(3, $result);
        $this->assertEquals('Etiqueta 1', $result[0]->name);
        $this->assertEquals('Descripció', $result[0]->description);
        $this->assertEquals('#0000FF', $result[0]->color);

        $this->assertEquals('Etiqueta 2', $result[1]->name);
        $this->assertEquals('Descripció', $result[1]->description);
        $this->assertEquals('#FF0000', $result[1]->color);

        $this->assertEquals('Etiqueta 3', $result[2]->name);
        $this->assertEquals('Descripció', $result[2]->description);
        $this->assertEquals('#000000', $result[2]->color);
    }

    /**
     * @test
     */
    public function can_edit_tag()
    {
        // 1
        $this->loginAsTagsManager('api');
        $oldTag = factory(Tag::class)->create([
            'name' => 'Etiqueta 1',
            'description' => 'Descripció',
            'color' => '#000000'
        ]);
        // 2
        $response = $this->json('PUT', '/api/v1/tags/' . $oldTag->id, [
            'name' => 'Etiqueta 15',
            'description' => 'Descripció 2',
            'color' => '#4286f4'
        ]);
        // 3
        $result = json_decode($response->getContent());
        $response->assertSuccessful();
        $newTag = $oldTag->refresh();
        $this->assertNotNull($newTag);
        $this->assertEquals('Etiqueta 15', $result->name);
        $this->assertEquals('Descripció 2', $result->description);
        $this->assertEquals('#4286f4', $result->color);

    }

}