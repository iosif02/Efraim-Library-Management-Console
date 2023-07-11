<?php

namespace App\Http\Requests;


use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
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
            'title' => 'required|string|unique:books,title',
            'category_id' => 'required|integer',
            'quantity' => 'nullable|integer',
            'image' => 'nullable',
            'price' => 'nullable|integer',
            'year' => 'nullable|integer',
            'publisher_id' => 'nullable|integer',
            'authors' => 'required|array',
        ];
    }
}
