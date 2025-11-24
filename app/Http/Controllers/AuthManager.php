<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class AuthManager extends Controller
{
    function register()
    {
        return view('registration');
    }
    function login()
    {
        return view('login');
    }
}
