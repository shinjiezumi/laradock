<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CommentRequest extends FormRequest
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
            'name' => 'required|max:255',
            'comment' => 'required|max:1024',
        ];
    }

    /**
     * @return array
     */
    public function messages(): array
    {
        return [
            'name.required' => '名前を入力してください。',
            'name.max' => '名前は255文字以下で入力してください。',
            'comment.required' => 'コメントを入力してください。',
            'comment.max' => 'コメントは1024文字以下で入力してください。',
        ];
    }
}
