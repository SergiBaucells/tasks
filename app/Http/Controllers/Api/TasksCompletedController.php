<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyTaskCompleted;
use App\Http\Requests\StoreTaskCompleted;
use App\Task;
use Illuminate\Http\Request;

class TasksCompletedController extends Controller
{

    public function store(StoreTaskCompleted $request, Task $task)
    {
        $task->completed = true;
        $task->save();
    }

    public function destroy(DestroyTaskCompleted $request, Task $task)
    {
        $task->completed = false;
        $task->save();
    }
}