<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserDestroyTaskCompleted;
use App\Http\Requests\UserStoreTaskCompleted;
use App\Task;

class LoggedUserTasksCompletedController extends Controller
{

    public function store(UserStoreTaskCompleted $request, Task $task)
    {
        $task->completed = true;
        $task->save();
    }

    public function destroy(UserDestroyTaskCompleted $request, Task $task)
    {
        $task->completed = false;
        $task->save();
    }
}