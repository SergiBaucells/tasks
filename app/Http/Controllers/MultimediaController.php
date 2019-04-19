<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Request;

class MultimediaController extends Controller
{
    public function index(Request $request)
    {

        return view('multimedia.index');

    }
}
