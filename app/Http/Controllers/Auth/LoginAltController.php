<?php


namespace App\Http\Controllers\Auth;


use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginAltController
{
    public function login(Request $request)
    {
        // Buscar el usuari a la BD i comprobar password OK!
        $user = User::where('email', $request->email)->first();

        if (!$user) return redirect()->route('login');

        if (!Hash::check($request->password, $user->password)) return redirect()->route('login');

        Auth::login($user);
        return redirect('/home');

    }

}