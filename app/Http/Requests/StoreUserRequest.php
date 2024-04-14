<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rule;
use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email|max:255',
            'phone' => [
                'required',
                'string',
                'unique:users',
                'max:20',
                'regex:/^\+?[0-9]+(-[0-9]+)*$/'
            ],
            'date_of_birth' => [
                'required',
                'date_format:Y-m-d',
                'before_or_equal:today'
            ],
        ];
    }
}
