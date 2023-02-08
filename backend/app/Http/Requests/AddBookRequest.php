<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Auth;

class AddBookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
//            'title' => 'required|unique:books,title',
            'title' => 'required|string',
            'category_id' => 'required|integer',
            'image' => 'required|image|mimes:png,jpg,jpeg|max:2048',
            'price' => 'integer|nullable',
            'year' => 'integer|nullable',
            'authors' => 'nullable'
        ];
    }
}
