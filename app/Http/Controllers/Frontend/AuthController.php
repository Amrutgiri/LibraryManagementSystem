<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login()
    {
        return view('Frontend.Auth.login');
    }
    public function forgot_password()
    {
        return view('Frontend.Auth.forgot-password');
    }
    public function register()
    {
        return view('Frontend.Auth.register');
    }
}
