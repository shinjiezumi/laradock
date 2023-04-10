<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class MyCollection extends Model
{
    public $table = 'mycollections';

    public function user()
    {
        $this->belongsTo('App\User');
    }

    public function collectionType()
    {
        $this->belongsTo('App\MCollectionType');
    }
}
