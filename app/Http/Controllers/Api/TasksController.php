<?php

namespace App\Http\Controllers\Api;

use App\Events\TaskDelete;
use App\Events\TaskStored;
use App\Events\TaskUpdate;
use App\Http\Requests\DestroyTask;
use App\Http\Requests\IndexTask;
use App\Http\Requests\ShowTask;
use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;
use App\Task;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class TasksController extends Controller
{

    public function index(IndexTask $request)
    {
        return map_collection(Task::orderBy('created_at', 'desc')->get());
    }

    public function show(ShowTask $request, Task $task) // Route Model Binding
    {
        return $task->map();
    }

    public function destroy(DestroyTask $request, Task $task)
    {
//        event(new TaskDelete($task->map()));
        $task->delete();
        return $task;
    }

    public function store(StoreTask $request, Task $task)
    {
//        Task:create();
        $task = new Task();
        $task->user_id = $request->user_id;
        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description ?? null;
        $task->save();
        event(new TaskStored($task, Auth::user()));
        return $task->map();
    }

    public function update(UpdateTask $request, Task $task)
    {
        $task_old = $task;
        $task->user_id = $request->user_id;
        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description ?? $task->description;
        $task->save();
        event(new TaskUpdate($task_old, $task, Auth::user()));
        return $task->map();
    }
}
