<?php

namespace App\DDD\Exceptions;

/**
 *
 */
class ResourceNotFoundException extends \Exception
{
    public function __construct()
    {
        parent::__construct('リソースが見つかりませんでした', 404, null);
    }
}
