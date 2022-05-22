<?php

namespace App\DDD\Todo\Application;

/**
 *
 */
class TodoGetCommand
{
    /**
     * @var int
     */
    private $page;

    /**
     * @param int $page
     */
    public function __construct(int $page)
    {
        $this->page = $page;
    }

    /**
     * @return int
     */
    public function getPage(): int
    {
        return $this->page;
    }
}
