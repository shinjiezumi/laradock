<?php

namespace App\DDD\Todo\Domain\Model;

class TodoId
{
    private $value;

    public function __construct(int $id)
    {
        $this->value = $id;
    }

    public function getId(): int
    {
        return $this->value;
    }
}
