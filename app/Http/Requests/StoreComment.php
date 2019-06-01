<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class StoreComment extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {

        if(Auth::guest() === false) {
            return true;
        }

        return false;
    }

    public function messages()
    {
        return [
            'text.required' => 'Комментарий не может быть пустым',
            'files.max' => 'Максимальное возможное количество фоток - 3'
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'text' => 'required',
            'posts_id' => 'required',
            'files' => 'max:3'
        ];
    }
}
