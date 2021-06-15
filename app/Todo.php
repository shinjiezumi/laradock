<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    public static $rules = [
        'title'	=>	'required|max:30',
        'body'	=>	'required|max:100',
        'limit'	=>	'date',
    ];

    protected $guarded = ['id'];
}
