<?php

namespace App\DDD\Todo\Domain\Model;

/**
 * Todo TODOモデル
 */
class Todo
{
    private $id;
    private $title;
    private $body;
    private $limit;

    /**
     * @param string|null $title
     * @param string|null $body
     * @param string|null $limit
     * @return array
     */
    public function __construct(?string $title, ?string $body, ?string $limit)
    {
        $errors = [];
        if ($title === null) {
            $errors['title'] = 'タイトルを入力してください';
        } else if (!(mb_strlen($title) <= 30)) {
            $errors['title'] = 'タイトルは30文字以下で入力してください';
        }

        if ($body === null) {
            $errors['body'] = '詳細を入力してください';
        } else if (!(mb_strlen($body) <= 100)) {
            $errors['body'] = '詳細は100文字以下で入力してください';
        }

        if ($limit === null) {
            $errors['limit'] = '期限を入力してください';
        } else if (!strtotime("Y/m/d", $limit)) {
            $errors['limit'] = '期限はY/m/d形式で入力してください';
        }

        if (count($errors) !== 0) {
            return $errors;
        }

        $this->title = $title;
        $this->body = $body;
        $this->limit = \DateTime::createFromFormat("Y/m/d", $limit);

        return [];
    }


}
