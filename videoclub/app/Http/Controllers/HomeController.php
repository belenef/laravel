<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function getHome()
    {
        //si el usuario no esta logueado lo redirige al login
        if (!auth()->check()) {
            return redirect('/login');
        }
        return view('home');
    }
}
