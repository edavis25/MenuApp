<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class AddonGroup extends Model
{
    /**
     * Properties that are mass assignable
     * @var array
     */
    protected $fillable = [
        'name', 'description', 'required', 'exclusive'
    ];
    /**
     * Relationship: Addon
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function addons()
    {
        return $this->hasMany(Addon::class);
    }

    public function getInputName()
    {
        return strtolower('addongroup_' . str_replace(' ', '_', $this->name));
    }
}
