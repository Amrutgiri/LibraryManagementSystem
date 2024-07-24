<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        return view("welcome");
    }
    public function profile()
    {
        return view('Frontend.User.profile');
    }
}
