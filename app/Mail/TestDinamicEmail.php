<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use stdClass;

class TestDinamicEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * TestDinamicEmail constructor.
     * @param $user
     */
    public function __construct($user)
    {
        $this->user = $user;
    }


    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
//        return $this->markdown('emails.testdinamic', [
//            'user' => $this->user
//        ]);
        return $this->markdown('emails.testdinamic');
    }
}
