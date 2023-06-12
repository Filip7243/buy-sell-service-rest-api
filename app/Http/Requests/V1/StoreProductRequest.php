<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class StoreProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        $user = $this->user();
        if ($user->tokenCan('product:create')) {
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
            'name' => 'required',
            'description' => 'required',
            'image' => 'nullable|image|mimes:jpg',
            'price' => 'required|decimal:1,6',
            'quantity' => 'required',
            'condition' => 'required|in:NEW,USED',
            'type' => 'required|in:FOR_SALE,TO_BUY',
            'category_id' => 'required|exists:App\Models\Category,id',
            'user_id' => 'required|exists:App\Models\User,id'
        ];
    }
}
