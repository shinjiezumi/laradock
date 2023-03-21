<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    /**
     * @var string[]
     */
    protected $guarded = ['id'];

    /**
     * @var string[]
     */
    public static $rules = [
        'board_id' => 'required',
        'comment' => 'required',
        'name' => 'required',
    ];

    /**
     * @return BelongsTo
     */
    public function board()
    {
        return $this->belongsTo(Board::class);
    }
}
