<?php

namespace App\Http\Controllers\Api;

use App\Events\TaskCompleted;
use App\Events\TaskUncompleted;
use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyTaskCompleted;
use App\Http\Requests\StoreTaskCompleted;
use App\Task;

class TasksCompletedController extends Controller
{

    public function store(StoreTaskCompleted $request, Task $task)
    {
        $task->completed = true;
        $task->save();
        event(new TaskCompleted($task));
    }

    public function destroy(DestroyTaskCompleted $request, Task $task)
    {
        $task->completed = false;
        $task->save();
        // HOOK -> EVENT
        event(new TaskUncompleted($task));
    }
}
