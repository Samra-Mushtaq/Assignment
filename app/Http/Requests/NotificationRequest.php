<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NotificationRequest extends FormRequest
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
            'title_en' => 'required|min:5',
            'title_ar' => 'required',
            'description_en' => 'required|min:5',
            'description_ar' => 'required'
        ];
    }

    public function messages()
    {
        return [
            'title_en.required' => 'Title (en) field is required',
            'title_ar.required'  => 'Title (ar) field is required',
            'description_en.required' => 'Description (en) field is required',
            'description_ar.required'  => 'Description (ar) field is required',
        ];
    }
}
