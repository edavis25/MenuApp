<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    /**
     * Properties that are mass assignable
     * @var array
     */
    protected $fillable = [
        'quantity', 'item_price', 'item_discount', 'menu_item_id', 'order_id', 'addons'
    ];

    /**
     * Relationship: Belongs to Order
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function menuItem()
    {
        return $this->hasOne(MenuItem::class);
    }
}
