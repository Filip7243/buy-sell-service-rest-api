<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'first_name' => 'required',
            'last_name' => 'required',
            'phone_number' => 'required',
            'country' => 'required',
            'postal_code' => 'required',
            'city' => 'required',
            'street' => 'required',
            'flat_number' => 'nullable|numeric',
            'house_number' => 'required|numeric',
            'email' => 'required|email|unique:users,email',
            'password' => 'required',
        ];
    }
}
