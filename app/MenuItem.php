<?php

namespace App;

use App\Traits\FormatsPrice;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    /** @trait App\Traits\FormatsPrice */
    use FormatsPrice;

    /**
     * Properties that are mass assignable
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'price', 'category_id'
    ];

    /**
     * Relationship: Has Many Addon Groups
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addonGroups()
    {
        return $this->hasMany(AddonGroup::class);
    }

    /**
     * Relationship: Belongs To a Category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
