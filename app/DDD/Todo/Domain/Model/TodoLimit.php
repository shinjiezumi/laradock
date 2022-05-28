<?php

namespace App\DDD\Todo\Domain\Model;

use DateTime;
use Illuminate\Validation\ValidationException;

class TodoLimit
{
    private $value;

    public function __construct(string $limit)
    {
        if ($limit === '') {
            throw ValidationException::withMessages(['limit' => '期限を入力してください']);
        }

        $limitDate = DateTime::createFromFormat("Y/m/d", $limit);
        if (!$limitDate) {
            throw ValidationException::withMessages(['limit' => '期限はY/m/d形式で入力してください']);
        }

        $this->value = $limitDate;
    }

    public function toString(): string
    {
        return $this->value->format('Y-m-d');
    }
}
