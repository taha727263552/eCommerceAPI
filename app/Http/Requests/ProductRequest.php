<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'name' => 'bail|required|max:255|unique:products',
            'price' =>'required|Numeric|min:10',
            'detail' => 'required',
            'stock' => 'required|max:6',
            'discount' =>'required|max:2',
            'user_id' => 'required'
        ];
    }
}
