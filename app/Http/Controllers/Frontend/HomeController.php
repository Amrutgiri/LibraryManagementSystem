<?php

namespace App\Http\Controllers\Frontend;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{

    public function index()
    {
        return view("welcome");
    }
    public function profile()
    {
        if (Auth::check()) {

            return view('Frontend.User.profile');
        } else {
            return redirect('/');
        }
    }
}
