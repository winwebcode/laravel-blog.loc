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

    public function seo(Request $request)
    {
        $this->validate($request, [
            'title' => 'required',
            'description' => 'required',
            'keywords' => 'required'
        ]);
        $seoTags = Settings::where('name', '=', 'seoMeta')->firstOrFail();
        $seoTags->seoMetaTagsSet($request->all());
        return redirect()->back()->with('status', 'Данные мета тегов обновлены!');
    }
}
