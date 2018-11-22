<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\DestroyTask;
use App\Http\Requests\IndexTask;
use App\Http\Requests\ShowTask;
use App\Http\Requests\StoreTask;
use App\Http\Requests\UpdateTask;
use App\Task;
use App\Http\Controllers\Controller;

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
        $task->delete();
    }

    public function store(StoreTask $request)
    {
//        Task:create();
        $task = new Task();
        $task->user_id = $request->user_id;
        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description ?? null;
        $task->save();
        return $task->map();
    }

    public function update(UpdateTask $request, Task $task)
    {
        $task->user_id = $request->user_id;
        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->description = $request->description ?? $task->description;
        $task->save();
        return $task->map();
    }
}
