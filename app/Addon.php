<?php

namespace App;

use App\Traits\FormatsPrice;
use Illuminate\Database\Eloquent\Model;

class Addon extends Model
{
    /** @trait App\Traits\FormatsPrice */
    use FormatsPrice;

    /**
     * Properties that are mass assignable
     * @var array
     */
    protected $fillable = [
        'name', 'price', 'addon_group_id'
    ];

    /**
     * Properties that are appended to serialized model
     * @var array
     */
    protected $appends = [
        'group_name'
    ];

    /**
     * Accessor: Get appended addon group name property
     */
    public function getGroupNameAttribute()
    {
        return $this->addonGroup->name ?? '';
    }

    /**
     * Relationship: Belongs To Addon Group
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function addonGroup()
    {
        return $this->belongsTo(AddonGroup::class);
    }
}
