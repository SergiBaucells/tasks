<?php

namespace Tests\Unit;
use InvalidArgumentException;
use Tests\TestCase;

/**
 * Class ImgOptimizeTest.
 *
 * @package Tests\Unit
 */
class ImgOptimizeTest extends TestCase
{
    /**
     * @test
     * @group slow
     */
    public function command_img_optimize_exists_and_arguments_are_optional()
    {
        $this->artisan('img:optimize')
            ->expectsQuestion('Please enter image path: ', base_path('tests/__Fixtures__/ImgOptimizeTests/test.jpg'))
            ->expectsOutput('Optimizing...')
            ->assertExitCode(0);
        $this->assertTrue(true);
    }

    /**
     * @ test
     * @group slow
     */
    public function file_not_exists()
    {
        $path = base_path('tests/__Fixtures__/ImgOptimizeTests/NOTEXISTINGFILE.jpg');
        try {
            $this->artisan('img:optimize', [
                    'path' => $path]
            );
        } catch (InvalidArgumentException $e ) {
            $this->assertEquals('`/home/sergi/Code/baucells/tasks/tests/__Fixtures__/ImgOptimizeTests/NOTEXISTINGFILE.jpg` does not exist',$e->getMessage());
            return;
        }
        $this->fail('InvalidArgumentException. Error. Path argument does not exists');

    }

}
