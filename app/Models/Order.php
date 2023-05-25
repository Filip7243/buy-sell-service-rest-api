<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\ProductCondition;
use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'price',
        'quantity',
        'order_status',
        'product_id',
        'user_id'
    ];

    protected $casts = [
        'order_status' => OrderStatus::class
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
