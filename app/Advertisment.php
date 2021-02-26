<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Advertisment extends Model
{
    protected $fillable =['code', 'label', 'name', 'id'];
    protected $table = 'advertisment';

    public function editCodes($fields)
    {
        $this->fill($fields);
        $this->save();
    }


}
