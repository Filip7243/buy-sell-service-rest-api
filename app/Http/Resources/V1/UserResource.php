<?php

namespace App\Http\Resources\V1;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
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
            'first_name' => $this->first_name,
            'last_name' => $this->last_name,
            'phone_number' => $this->phone_number,
            'country' => $this->country,
            'city' => $this->city,
            'postal_code' => $this->postal_code,
            'street' => $this->street,
            'home_number' => $this->flat_number,
            'house_number' => $this->house_number,
            'email' => $this->email,
            'roles' => RoleResource::collection($this->roles)
        ];
    }
}
