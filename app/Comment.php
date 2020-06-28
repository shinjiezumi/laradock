<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $guarded = ['id'];

    public static $rules = [
        'board_id' => 'required',
        'comment' => 'required',
        'author' => 'required',
    ];

}
