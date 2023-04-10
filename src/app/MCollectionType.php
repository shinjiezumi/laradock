<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MCollectionType extends Model
{
    public function mycollections()
    {
        return $this->hasMany('App\MCcollection');
    }


}
