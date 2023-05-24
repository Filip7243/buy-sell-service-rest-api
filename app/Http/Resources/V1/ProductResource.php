<?php

namespace App\Http\Resources\V1;

use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'image' => $this->image,
            'price' => $this->price,
            'quantity' => $this->quantity,
            'condition' => $this->product_condition,
            'type' => $this->type,
            'categories' => CategoryResource::collection($this->categories),
            'user' => UserResource::collection($this->users) // TODO: make resource for user!
        ];
    }
}
