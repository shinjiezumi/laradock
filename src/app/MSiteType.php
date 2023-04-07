<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MSiteType extends Model
{
    public function mysites()
    {
        return $this->hasMany('App\MySite');
    }
}
