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
        $mappedTags = collect($request->tags)->map(function ($tag){
            if (is_int($tag)){
                return $tag;
            }else{
                return Tag::create([
                    'name' => $tag,
                    'color' => 'grey',
                    'description' => ''
                ])->id;
            }
        });
        $task->addTags(Tag::find($mappedTags));
    }

}
