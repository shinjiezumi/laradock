<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
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
    public function rules()
    {
        return [
            'title' => 'required|max:30',
            'body' => 'required|max:100',
            'limit' => 'required|date_format:Y-m-d',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'title.required' => 'タイトルを入力してください。',
            'title.max' => 'タイトルは30文字以下で入力してください。',
            'body.required' => '詳細を入力してください。',
            'body.max' => '詳細は100文字以下で入力してください。',
            'limit.required' => '期限を入力してください。',
            'limit.date_format' => '期限はY-m-d形式で入力してください',
        ];
    }
}
