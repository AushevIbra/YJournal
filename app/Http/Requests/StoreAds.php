<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreAds extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    public function messages(){
        return [
            'name.required'        => 'Заполните имя',
            'number.required'      => 'Укажите номер телефона',
            'category_id.required' => 'Выберите категорию',
            'category_id.integer'  => 'Неправильный формат категории',
            'title.required'       => 'Заполните название',
            'title.min'            => 'В названии должно быть более 25-ти символов',
            'title.max'            => 'Превыщено максимальное кол-во символов в названии',
            'content.required'     => 'Заполните описание',
            'content.min'          => 'В описании должно быть более 25-ти символов ',
            'price.required'       => 'Заполните цену',
            'address.required'     => 'Укажите адрес',
        ];
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules(){
        return [
            'name'        => 'required',
            'number'      => 'required',
            'category_id' => 'required|integer',
            'title'       => 'required|max:255|min:25',
            'content'     => 'required|min:25',
            'price'       => 'required',
            'address'     => 'required',

        ];
    }
}
