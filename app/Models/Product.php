<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'description'];

    public function orders(): BelongsToMany
    {
        return $this->belongsToMany(Order::class, OrderProduct::class)
            ->using(OrderProduct::class)
            ->withPivot(['price', 'quantity']);
    }
}
