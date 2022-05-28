<?php

namespace App\DDD\Todo\Domain\Model;

use Illuminate\Validation\ValidationException;

class TodoTitle
{
    private $value;

    public function __construct(string $title)
    {
        if ($title === '') {
            throw ValidationException::withMessages(['title' => 'タイトルを入力してください']);
        } else if (!(mb_strlen($title) <= 30)) {
            throw ValidationException::withMessages(['title' => 'タイトルは30文字以下で入力してください']);
        }

        $this->value = $title;
    }

    public function toString(): string
    {
        return $this->value;
    }
}
