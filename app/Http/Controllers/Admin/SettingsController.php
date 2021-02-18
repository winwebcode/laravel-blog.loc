<?php

namespace App\Http\Controllers\Admin;

use App\Settings;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Cache;

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

    public function metaTagsForIndex(Request $request)
    {
        $settings = Settings::all();
        $settings->setMetaTagsForIndex($request->all());
        return redirect()->back()->with('status', 'Данные обновлены');
    }

    /*cache*/
    public function clearAllCache()
    {
        Cache::flush();
        return redirect()->back()->with('status', 'Весь кэш очищен');
    }

    public function clearPostsCache()
    {
        Cache::forget('allPosts');
        return redirect()->back()->with('status', 'Кэш записей очищен');
    }
}
