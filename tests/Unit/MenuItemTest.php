<?php

namespace Tests\Unit;

use App\AddonGroup;
use App\Category;
use App\MenuItem;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuItemTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_menu_item_has_addon_groups()
    {
        $menu_item = factory(MenuItem::class)->create();
        factory(AddonGroup::class)->create(['menu_item_id' => $menu_item]);

        $this->assertInstanceOf(Collection::class, $menu_item->addonGroups);
        $this->assertEquals(1, $menu_item->addonGroups->count());
        $this->assertInstanceOf(AddonGroup::class, $menu_item->addonGroups->first());
    }

    /** @test */
    public function a_menu_item_belongs_to_a_category()
    {
        $category = factory(Category::class)->create();
        $menu_item = factory(MenuItem::class)->create(['category_id' => $category->id]);

        $this->assertInstanceOf(Category::class, $menu_item->category);
    }
}
