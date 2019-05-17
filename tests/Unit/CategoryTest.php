<?php

namespace Tests\Unit;

use App\Category;
use App\MenuItem;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_category_has_menu_items()
    {
        $num_items  = random_int(1, 10);
        $category   = factory(Category::class)->create();
        factory(MenuItem::class, $num_items)->create(['category_id' => $category->id]);

        $this->assertInstanceOf(Collection::class, $category->menuItems);
        $this->assertEquals($num_items, $category->menuItems->count());
        $this->assertInstanceOf(MenuItem::class, $category->menuItems->first());
    }
}
