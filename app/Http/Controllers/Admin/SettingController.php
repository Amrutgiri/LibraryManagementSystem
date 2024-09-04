<?php

namespace App\Http\Controllers\Admin;

use App\Models\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::first();

        return view('Admin.settings.index', [
            'title' => 'Settings',
            'settings' => $settings,
        ]);
    }

    public function update(Request $request, $id)
    {
        $settings = Setting::find($id);

        // dd($request->all());

        $settings->update($request->all());

        return redirect()->route('admin.settings')->with('success', 'Settings updated successfully');
    }
}
