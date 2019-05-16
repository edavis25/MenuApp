<?php


namespace App;


class ShoppingCartItem
{
    /** @var App\MenuItem */
    protected $item;

    /** @var App\Addon[] */
    protected $addons;

    /** @var App\AddonGroup[] */
    protected $addon_groups;

    /** @var int */
    protected $quantity;

    /**
     * ShoppingCartItem constructor.
     * @param int   $item_id
     * @param array $group_ids
     * @param array $addon_ids
     * @param int   $quantity
     */
    public function __construct($item_id, $group_ids, $addon_ids, $quantity = 1)
    {
        $this->setItem($item_id);
        $this->setAddonGroups($group_ids);
        $this->setAddons($addon_ids);
        $this->quantity = $quantity;
    }

    /**
     * Set Item
     * @param int $item_id
     */
    public function setItem($item_id)
    {
        $this->item = MenuItem::find($item_id);
    }

    /**
     * Set Addon Groups
     * @param  array $group_ids
     * @return array
     */
    public function setAddonGroups($group_ids)
    {
        $groups = [];
        foreach ($group_ids as $id) {
            $group = AddonGroup::find($id);
            if ($group) {
                $groups[] = $group;
            }
        }
        return $this->addon_groups = $groups;
    }

    /**
     * Set Addons
     * @param  array $addon_ids
     * @return array
     */
    public function setAddons($addon_ids)
    {
        $addons = [];
        foreach ($addon_ids as $id) {
            $addon = Addon::find($id);
            if ($addon) {
                $addons[] = $addon;
            }
        }
        return $this->addons = $addons;
    }

    /**
     * Get Addon Groups
     * @return App\AddonGroup[]
     */
    public function addonGroups()
    {
        return $this->addon_groups;
    }

    /**
     * Get Menu Item
     * @return App\MenuItem
     */
    public function item() : MenuItem
    {
        return $this->item;
    }

    /**
     * Get Addons by Group ID
     * @param  int $id
     * @return array
     */
    public function addonsByGroupId($id)
    {
        $addons = [];
        foreach ($this->addons as $addon) {
            if ($addon->addon_group_id == $id) {
                $addons[] = $addon;
            }
        }
        return $addons;
    }
}