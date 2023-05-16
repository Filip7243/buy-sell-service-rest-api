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
        'type',
        'category_id',
        'user_id'
    ];

    protected $casts = [
        'type' => ProductType::class,
        'product_condition' => ProductCondition::class
    ];

    public function categories()
    {
        return $this->hasMany(Category::class, 'id', 'category_id');
    }

    public function users()
    {
        return $this->hasMany(User::class, 'id', 'user_id');
    }

    public function order()
    {
        return $this->belongsTo(Order::class);
    }
}
