<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UserController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');

    }

    public function showRegisterForm()
    {
        return view('auth.register');
    }

    public function login()
    {

    }

}
