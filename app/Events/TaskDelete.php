<?php

namespace App\Events;

use App\Task;
use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class TaskDelete implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $task, $user;

    /**
     * Create a new event instance.
     *
     * @param array $oldTask
     */
    public function __construct(array $oldTask)
    {
        $this->oldTask = $oldTask;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return[
            new PrivateChannel('App.User.' . $this->task['user_id']),
            new PrivateChannel('Tasques')
        ];
    }
}
