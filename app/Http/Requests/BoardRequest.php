<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BoardRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(): array
    {
        return [
            'author' => 'required|max:255',
            'title' => 'required|max:255',
            'body' => 'required|max:1024',
            'tags' => 'array',
            'tags.*' => 'integer',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'author.required' => '投稿名を入力してください。',
            'author.max' => '投稿名は255文字以下で入力してください。',
            'title.required' => 'タイトルを入力してください。',
            'title.max' => 'タイトルは255文字以下で入力してください。',
            'body.required' => '本文を入力してください。',
            'body.max' => '本文は255文字以下で入力してください。',
            'tags.array' => 'タグが不正です',
            'tags.*' => 'タグが不正です',
        ];
    }
}
