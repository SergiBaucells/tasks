<?php

namespace App\Http\Controllers;

use App\Task;
use Illuminate\Http\Request;

class TasquesController extends Controller
{
    public function index()
    {
        // Agafa de la base de dades i ho passa a la vista
        $tasks = Task::orderBy('created_at', 'desc')->get();
        return view('tasques', compact('tasks'));
    }
}
