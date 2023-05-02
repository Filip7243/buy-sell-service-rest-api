<?php

namespace App\Models;

use App\Enums\ProductCondition;
use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'quantity',
        'product_condition',
        'type'
    ];

    protected $casts = [
        'type' => ProductType::class,
        'product_condition' => ProductCondition::class
    ];

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
}
