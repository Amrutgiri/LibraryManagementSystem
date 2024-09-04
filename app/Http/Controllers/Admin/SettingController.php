<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all();


        return view('Admin.settings.index', [
            'title' => 'Settings',
            'settings' => $settings,
        ]);
    }

}
