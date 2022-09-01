<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
            'en_name' => 'required|min:5|unique:categories',
            'ar_name' => 'required',
            'en_detail' => 'required|min:5',
            'ar_detail' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'en_name.required' => 'Name (en) field is required',
            'en_name.unique' => 'Given Name (en) is already assigned',
            'ar_name.required'  => 'Name (ar) field is required',
            'en_detail.required' => 'Detail (en) field is required',
            'ar_detail.required'  => 'Detail (ar) field is required',
        ];
    }
}
