<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MySite extends Model
{
    public $table = 'mysites';

    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function siteType()
    {
        $this->belongsTo('App\MSiteType');
    }
}
