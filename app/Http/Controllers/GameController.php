<?php

namespace App\Http\Controllers;

use App\Http\Requests\UsersIndex;
use App\User;
use Illuminate\Http\Request;

class GameController extends Controller
{
    public function index(Request $request)
    {
        return view('game.index');
    }
}