<?php

namespace App\Models;

use App\Enums\OrderStatus;
use App\Enums\OrderType;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'order_num', 'type', 'status'];

    protected $casts = [
        'status' => OrderStatus::class,
        'type' => OrderType::class,
    ];

    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, OrderProduct::class)
            ->using(OrderProduct::class)
            ->withPivot(['price', 'quantity'])
            ->withTimestamps();
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
