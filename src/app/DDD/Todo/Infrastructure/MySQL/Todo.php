<?php

namespace App\DDD\Todo\Infrastructure\MySQL;

use Illuminate\Database\Eloquent\Model;

class Todo extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    protected $dates = ['limit'];
}
