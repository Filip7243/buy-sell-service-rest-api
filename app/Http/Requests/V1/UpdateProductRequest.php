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
        $user = $this->user();
        if ($user->tokenCan('product:update')) {
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

        if ($this->isMethod('PUT')) {
            return [
                'name' => 'required',
                'description' => 'required',
                'image' => 'image|mimes:jpeg,png,jpg|size:1024',
                'price' => 'required|decimal:1,6',
                'quantity' => 'required',
                'product_condition' => 'required|in:NEW,USED',
                'type' => 'required|in:FOR_SALE,TO_BUY',
                'category_id' => 'required|exists:App\Models\Category,id',
            ];
        }

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
