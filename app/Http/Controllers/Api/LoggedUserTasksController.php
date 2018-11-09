<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Task;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoggedUserTasksController extends Controller
{
    public function index()
    {
        return Auth::user()->tasks;
    }

    public function store(Request $request)
    {
        // Afegir tasca nova i afegir a usuari logat
        $task = Request::create($request->only(['name', 'completed']));
        return Auth::user()->addTask($task);
    }

    public function destory(Request $request, Task $task)
    {
        $task->delete();
        return Auth::user()->removeTask($task);
    }

    public function update(Request $request, Task $task)
    {
        Auth::user()->tasks()->findOrFail($task->id);

        $task->name = $request->name;
        $task->completed = $request->completed;
        $task->save();

//        if (Auth::user()->haveTask($task)) {
//            $task->name = $request->name;
//            $task->completed = $request->completed;
//            $task->save();
//        }
    }
}
