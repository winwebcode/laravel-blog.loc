<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class Subscriber extends Model
{
    protected $table = 'subscriptions';
    //
    public static function add($email)
    {
        $sub = new static;
        $sub->email = $email;
        $sub->save();

        return $sub;
    }

    public function generateToken()
    {
        $this->token = str_random(100);
        $this->save();
    }

    public function remove()
    {
        $this->remove();
    }

    public function deleteNonActive()
    { // удаление подписчиков не активировавших ссылку в течении 30 дней

        if($this->token != null and $this->diffDays() >30){
            $this->delete();
        } else {

        }
    }

    public function diffDays()
    {
        $dateSubscribe = $this->updated_at;
        $dateNow = Carbon::now();
        $difference = $dateSubscribe->diffInDays($dateNow);
        if ($difference > 30) {
            return $difference;
        }

    }
}
