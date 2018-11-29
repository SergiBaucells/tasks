<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\DestroyTag;
use App\Http\Requests\IndexTag;
use App\Http\Requests\ShowTag;
use App\Http\Requests\StoreTag;
use App\Http\Requests\UpdateTag;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{

    public function index(IndexTag $request)
    {
        return map_collection(Tag::orderBy('created_at', 'desc')->get());
    }

    public function store(StoreTag $request)
    {
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();
        return $tag->map();
    }

    public function show(ShowTag $tag)
    {
        return $tag->map();
    }

    public function update(UpdateTag $request, Tag $tag)
    {
        $tag->name = $request->name;
        $tag->description = $request->description;
        $tag->color = $request->color;
        $tag->save();
        return $tag->map();
    }

    public function destroy(DestroyTag $tag)
    {
        $tag->delete();
    }
}
