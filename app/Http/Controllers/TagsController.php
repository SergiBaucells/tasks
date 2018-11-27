<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexTag;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(IndexTag $request)
    {
        $tags = map_collection(Tag::orderBy('created_at', 'desc')->get());
        return view('tags', ['tags' => $tags]);
    }

}