<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    /**
     * Properties that are mass assignable
     * @var array
     */
    protected $fillable = [
        'subtotal', 'total', 'tax', 'discount', 'user_id'
    ];

    /**
     * Relationship: Has Many Order Items
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }
}
