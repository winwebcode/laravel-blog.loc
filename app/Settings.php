<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Settings extends Model
{
    protected $fillable = ['name', 'status', 'description', 'title', 'keywords'];
    protected $table = 'settings';

    const ON = 1;
    const OFF = 0;

    public function getStatus()
    {
        if($this->status == Settings::ON) {
            return 'Включено';
        } else {
            return 'Выключено';
        }
    }

    public function tumblerSettings()
    {
        if($this->status == Settings::ON) {
            return $this->tumblerOff();
        } else {
            return $this->tumblerOn();
        }
    }

    public function tumblerOn()
    {
        $this->status = Settings::ON;
        $this->save();
    }

    public function tumblerOff()
    {
        $this->status = Settings::OFF;
        $this->save();
    }

    public function seoMetaTagsSet($request)
    {
        unset($request['_token']);
        $request = implode(",", $request);
        $request = strip_tags(htmlspecialchars_decode($request));
        $this->data = $request;
        $this->save();
    }

    public static function getSeoForIndex()
    {
        $seoSettings = Settings::where('name', 'seoMeta')->get();
        //$seoMeta = explode(",", $seoMeta);
        foreach ($seoSettings as $seo) {
            $seoMeta = explode(",", $seo->data);
        }

        return $seoMeta;
    }

}
