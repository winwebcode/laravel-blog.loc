<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Settings extends Model
{
    protected $fillable = ['name', 'status'];
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
}
