<?php

namespace App\DDD\Todo\Domain\Model;

class TodoId
{
    /**
     * @var int
     */
    private $value;

    /**
     * @param int $id
     */
    public function __construct(int $id)
    {
        $this->value = $id;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->value;
    }
}
