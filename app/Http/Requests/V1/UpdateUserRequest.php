<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if ($user->tokenCan('user:update')) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $method = $this->method();

        if ($method == 'PUT') {
            return [
                'first_name' => 'required',
                'last_name' => 'required',
                'phone_number' => 'required|max:12',
                'country' => 'required',
                'postal_code' => 'required',
                'city' => 'required',
                'street' => 'required',
                'flat_number' => 'required|numeric',
                'house_number' => 'required|numeric',
                'email' => 'required|email|unique:users,email,'.$this->user()->id
            ];
        } else {
            return [
                'first_name' => 'sometimes|required',
                'last_name' => 'sometimes|required',
                'phone_number' => 'sometimes|required|max:12',
                'country' => 'sometimes|required',
                'postal_code' => 'sometimes|required',
                'city' => 'sometimes|required',
                'street' => 'sometimes|required',
                'flat_number' => 'sometimes|required|numeric',
                'house_number' => 'sometimes|required|numeric',
                'email' => 'sometimes|required|email|unique:users,email,'.$this->user()->id
            ];
        }
    }
}
