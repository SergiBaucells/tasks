<?php

namespace App\Http\Controllers;

use App\Http\Requests\IndexTag;
use App\Http\Requests\IndexUserTag;
use App\Tag;
use Illuminate\Http\Request;

class TagsController extends Controller
{
    public function index(IndexUserTag $request)
    {
        $tags = map_collection(Tag::orderBy('created_at', 'desc')->get());
        $uri = '/api/v1/tags';
        return view('tags', compact('tags','uri'));
    }

}