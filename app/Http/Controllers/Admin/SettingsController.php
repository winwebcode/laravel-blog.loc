<?php

namespace App\Http\Controllers\Admin;

use App\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class SettingsController extends Controller
{
    public function showSettings()
    {
        $settings = Settings::all();

        return view('admin.settings.index', compact('settings'));
    }


    public function tumbler($id)
    {
        $settings = Settings::find($id);
        $settings->tumblerSettings();

        return redirect()->route('settings');
    }
}
