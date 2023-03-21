<?php

namespace App\DDD\Exceptions;

class ResourceNotFoundException extends \Exception
{
    /**
     * 例外メッセージ
     */
    const MESSAGE = 'リソースが見つかりませんでした';

    /**
     * @param string $message
     */
    public function __construct(string $message = self::MESSAGE)
    {
        parent::__construct($message, 404, null);
    }
}
