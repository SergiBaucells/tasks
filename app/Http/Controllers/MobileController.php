<?php

namespace App\Http\Controllers;

use App\Http\Requests\UserMobileIndex;

/**
 * Class MobileController.
 *
 * @package App\Http\Controllers
 */
class MobileController extends Controller
{
    public function index(UserMobileIndex $request)
    {
        return view('mobile');
    }
}
