<?php

namespace App\Providers;

use App\Events\TaskCompleted;
use App\Events\TaskDelete;
use App\Events\TaskStored;
use App\Events\TaskUpdate;
use App\Listeners\AddRolesToRegisterUser;
use App\Listeners\SendMailTaskCompleted;
use App\Listeners\EmailTaskDelete;
use App\Listeners\EmailTaskStored;
use App\Listeners\SendMailTaskUncompleted;
use App\Listeners\EmailTaskUpdated;
use App\Listeners\LogTaskCompleted;
use App\Listeners\LogTaskDelete;
use App\Listeners\LogTaskStored;
use App\Listeners\LogTaskUncompleted;
use App\Events\TaskUncompleted;
use App\Listeners\LogTaskUpdated;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
            AddRolesToRegisterUser::class
        ],
        TaskUncompleted::class => [
            LogTaskUncompleted::class,
            SendMailTaskUncompleted::class
        ],
        TaskCompleted::class => [
            LogTaskCompleted::class,
            SendMailTaskCompleted::class
        ],
        TaskStored::class => [
            LogTaskStored::class,
            EmailTaskStored::class,
        ],
        TaskUpdate::class => [
            LogTaskUpdated::class,
            EmailTaskUpdated::class
        ],
        TaskDelete::class => [
            LogTaskDelete::class,
            EmailTaskDelete::class
        ]
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
