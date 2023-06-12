<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    use HasFactory;
    use Filterable;

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

    public function product() : BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
