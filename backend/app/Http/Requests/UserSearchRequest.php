<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class UserSearchRequest extends FormRequest
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
            'name' => 'nullable|string',
            'pagination' => 'required',
            'pagination.per_page' => 'required|integer',
            'pagination.page' => 'required|integer',
        ];
    }

//    /**
//     * Custom message for validation
//     *
//     * @return array
//     */
//    public function messages()
//    {
//        return [
//            'title.required' => 'Title is required!'
//        ];
//    }
}
