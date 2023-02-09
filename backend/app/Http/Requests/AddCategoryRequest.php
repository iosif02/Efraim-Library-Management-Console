<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddCategoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string',
            'number' => 'required|integer',
            'description' => 'nullable|string'
        ];
    }

//    /**
//     * Get the error messages that apply to the request parameters.
//     *
//     * @return array
//     */
//    public function messages()
//    {
//        return [
//            'description.required' => 'custom message',
//        ];
//    }
}
