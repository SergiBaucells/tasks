<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasksController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tasks = Task::all();
        return view('tasks', ['tasks' => $tasks]);
    }

    public function store(Request $request)
    {
        Task::create([
            'name' => $request->name,
            'completed' => false
        ]);
        return redirect('/tasks');
    }

    public function destroy($id)
    {
        $task = Task::findOrFail($id);
        $task->delete();
        return redirect()->back();
    }

    public function edit($id)
    {
        $task = Task::findOrFail($id);
        return view('edit', compact('task', 'id'));
    }

    public function update(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->name = $request->input('name');
        $task->save();
        return redirect('tasks');
    }

    public function completed(Request $request, $id)
    {
        $task = Task::findOrFail($id);
        $task->completed = $request->get('completed');
        $task->completed = $request->set('true');
        return redirect('tasks');
    }


}
