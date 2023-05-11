<?php

namespace App\Http\Requests\V1;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'name' => 'sometimes|required',
            'description' => 'sometimes|required',
            'image' => 'sometimes|image|mimes:jpeg,png,jpg|size:1024',
            'price' => 'sometimes|required|decimal:1,6',
            'quantity' => 'sometimes|required',
            'product_condition' => 'sometimes|required|in:NEW,USED',
            'type' => 'sometimes|required|in:FOR_SALE,TO_BUY',
            'category_id' => 'sometimes|required|exists:App\Models\Category,id',
        ];
    }
}
