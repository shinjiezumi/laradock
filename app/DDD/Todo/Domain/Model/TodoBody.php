<?php

namespace App\DDD\Todo\Domain\Model;

use Illuminate\Validation\ValidationException;

class TodoBody
{
    private $value;

    public function __construct(string $body)
    {
        if ($body === '') {
            throw ValidationException::withMessages(['body' => '詳細を入力してください']);
        } else if (!(mb_strlen($body) <= 100)) {
            throw ValidationException::withMessages(['body' => '詳細は100文字以下で入力してください']);
        }

        $this->value = $body;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
