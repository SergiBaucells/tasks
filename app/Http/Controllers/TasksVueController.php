<?php

namespace App\Http\Controllers;

use App\Task;

class TasksVueController extends Controller
{
    public function index()
    {
        $tasks = Task::all();
        return view('tasks_vue',compact('tasks'));
    }
}
