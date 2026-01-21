<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    // public function showLogin()
    // {
    //     return view('auth.login');
    // }

    public function getLogin(Request $request)
    {
        // $credentials = $request->only('email', 'password');

        // if (Auth::attempt($credentials)) {
        //     $request->session()->regenerate();
        //     return redirect('/catalog'); // redirige al catálogo
        // }

        // return back()->withErrors([
        //     'email' => 'Las credenciales no coinciden.',
        // ]);
        return view('auth.login');
    }

    public function getLogout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login');
    }
}
