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
            'body'  => 'required|max:100',
            'limit' => 'required|date_format:Y/m/d H:i',
        ];
    }

    /**
     * @param null $keys
     * @return array
     */
    public function all($keys = null)
    {
        $results = parent::all($keys);
        if($this->filled('limit-date') && $this->filled('limit-time'))
        {
            $results['limit'] = $this->input('limit-date') . ' ' . $this->input('limit-time');
            unset($results['limit-date'], $results['limit-time']);
        }
        return $results;
    }
}
