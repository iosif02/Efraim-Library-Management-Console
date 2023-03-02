<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\Rule;

class BorrowBookRequest extends FormRequest
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
            'user_id' => [
                'required',
                'integer',
                Rule::unique('transactions')->where(function ($query){
                    return $query->where('is_returned', false)
                        ->where('user_id', request('user_id'))
                        ->where('book_id', request('book_id'));
                })
            ],
            'book_id' => [
                'required',
                'integer',
                Rule::unique('transactions')->where(function ($query){
                    return $query->where('is_returned', false)
                        ->where('user_id', request('user_id'))
                        ->where('book_id', request('book_id'));
                })
            ],
        ];
    }
}
