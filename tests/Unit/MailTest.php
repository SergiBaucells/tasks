<?php


namespace Tests\Unit;

use App\User;
use Illuminate\Support\Facades\Mail;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;


class MailTest extends TestCase
{
    use RefreshDatabase;

    /**
     * @test
     */
    public function send_email()
    {

        // 1
        $user = factory(User::class)->create();

        // 2
        Mail::to($user)->send(new TestEmail());
    }
}