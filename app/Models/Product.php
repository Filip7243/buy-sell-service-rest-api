<?php

namespace App\Models;

use Abbasudo\Purity\Traits\Filterable;
use App\Enums\ProductCondition;
use App\Enums\ProductType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;
    use Filterable;

    protected $fillable = [
        'name',
        'description',
        'image',
        'price',
        'quantity',
        'condition',
        'type',
        'is_promoted',
        'category_id',
        'user_id'
    ];

    protected $casts = [
        'type' => ProductType::class,
        'product_condition' => ProductCondition::class
    ];

    public $with = ['user', 'category'];

    public function category() : BelongsTo
    {
        return $this->belongsTo(Category::class, 'category_id', 'id');
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function orders() : HasMany
    {
        return $this->hasMany(Order::class, 'id', 'order_id');
    }
}
