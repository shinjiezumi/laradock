<?php

namespace App\DDD\Exceptions;

/**
 *
 */
class ResourceNotFoundException extends \Exception
{
    const MESSAGE = 'リソースが見つかりませんでした';

    public function __construct(string $message = self::MESSAGE)
    {
        parent::__construct($message, 404, null);
    }
}
