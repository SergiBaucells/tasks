<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\TasksTagsUpdate;
use App\Tag;
use App\Task;

class TasksTagsController extends Controller
{
    /**
     * Update the specified resource in storage.
     *
     * @param TasksTagsUpdate $request
     * @param Task $task
     * @return void
     */
    public function update(TasksTagsUpdate $request, Task $task)
    {
        $tags = Tag::find($request->tags);
        $task->addTags($tags);
    }
}
