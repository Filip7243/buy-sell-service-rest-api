<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreOrderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if ($user->tokenCan('order:create')) {
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
        return [
            'price' => 'required|decimal:1,6',
            'order_status' => 'required|in:PAID,NOT_PAID',
            'product_id' => 'required|exists:App\Models\Product,id',
            'user_id' => 'required|exists:App\Models\User,id'
        ];

        //TODO: in update too |unique:App\Models\Product,id
    }
}
