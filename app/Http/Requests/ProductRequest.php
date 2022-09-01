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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            //
            'en_name' => 'required|min:5',
            'ar_name' => 'required',
            'en_description' => 'required|min:5',
            'ar_description' => 'required',
            'price' => 'required',
            'status' => 'required',
            'categories' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'en_name.required' => 'Name (en) field is required',
            'ar_name.required'  => 'Name (ar) field is required',
            'en_description.required' => 'Description (en) field is required',
            'ar_description.required'  => 'Description (ar) field is required',
            'categories.required'  => 'Category field is required',
            'price.required' => 'Price field is required',
            'status.required'  => 'Status field is required',
        ];
    }
}
