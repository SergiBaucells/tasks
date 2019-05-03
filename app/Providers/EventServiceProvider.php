<?php

namespace App\Providers;

use App\Events\TaskCompleted;
use App\Events\TaskDelete;
use App\Events\TaskStored;
use App\Events\TaskUpdate;
use App\Listeners\AddRolesToRegisterUser;
use App\Listeners\EmailTaskCompleted;
use App\Listeners\EmailTaskUncompleted;
use App\Listeners\EmailTaskDelete;
use App\Listeners\EmailTaskStored;
use App\Listeners\EmailTaskUpdated;
use App\Listeners\ForgetTasksCache;
use App\Listeners\LogNotification;
use App\Listeners\LogTaskCompleted;
use App\Listeners\LogTaskDelete;
use App\Listeners\LogTaskStored;
use App\Listeners\LogTaskUncompleted;
use App\Events\TaskUncompleted;
use App\Listeners\LogTaskUpdated;
use App\Listeners\SendDatabaseNotificationStore;
use App\Listeners\SendTaskCompletedNotification;
use App\Listeners\SendTaskStoredNotification;
use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Notifications\Events\NotificationSent;

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
            AddRolesToRegisterUser::class,
            ForgetTasksCache::class
        ],
        TaskUncompleted::class => [
            LogTaskUncompleted::class,
            EmailTaskUncompleted::class,
            ForgetTasksCache::class
        ],
        TaskCompleted::class => [
            LogTaskCompleted::class,
            EmailTaskCompleted::class,
            ForgetTasksCache::class,
            SendTaskCompletedNotification::class
        ],
        TaskStored::class => [
            LogTaskStored::class,
            EmailTaskStored::class,
            ForgetTasksCache::class,
            SendTaskStoredNotification::class
        ],
        TaskUpdate::class => [
            LogTaskUpdated::class,
            EmailTaskUpdated::class,
            ForgetTasksCache::class
        ],
        TaskDelete::class => [
            LogTaskDelete::class,
            EmailTaskDelete::class,
            ForgetTasksCache::class
        ],
        NotificationSent::class => [
            LogNotification::class,
            SendDatabaseNotificationStore::class
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
