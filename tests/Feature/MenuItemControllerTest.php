<?php

namespace Tests\Feature;

use App\MenuItem;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class MenuItemControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function can_create_a_new_menu_item()
    {
        $menu_item = factory(MenuItem::class)->state('with-category')->raw();
        $this->post(route('admin.menu-item.store', $menu_item));
        $this->assertDatabaseHas('menu_items', [
            'name' => $menu_item['name'],
            'description' => $menu_item['description']
        ]);
    }

    /** @test */
    public function a_name_is_required_for_creating()
    {
        $menu_item = factory(MenuItem::class)->state('with-category')->raw(['name' => null]);
        $response = $this->post(route('admin.menu-item.store', $menu_item));
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function a_category_is_required_for_creating()
    {
        $menu_item = factory(MenuItem::class)->raw(['category_id' => null]);
        $response = $this->post(route('admin.menu-item.store', $menu_item));
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function a_price_is_required_for_creating()
    {
        $menu_item = factory(MenuItem::class)->raw(['price' => null]);
        $response = $this->post(route('admin.menu-item.store', $menu_item));
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function a_name_is_required_for_updating()
    {
        $menu_item = factory(MenuItem::class)->state('with-category')->create();
        $response = $this->put(route('admin.menu-item.update', $menu_item->id), [
            'name' => null,
            'description' => $menu_item->description,
            'price' => $menu_item->price,
            'category_id' => $menu_item->category->id
        ]);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function a_category_is_required_for_updating()
    {
        $menu_item = factory(MenuItem::class)->state('with-category')->create();
        $response = $this->put(route('admin.menu-item.update', $menu_item->id), [
            'name' => $menu_item->name,
            'description' => $menu_item->description,
            'price' => $menu_item->price,
            'category_id' => null
        ]);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function a_price_is_required_for_updating()
    {
        $menu_item = factory(MenuItem::class)->state('with-category')->create();
        $response = $this->put(route('admin.menu-item.update', $menu_item->id), [
            'name' => $menu_item->name,
            'description' => $menu_item->description,
            'category_id' => $menu_item->category->id,
            'price' => null
        ]);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function a_menu_item_can_be_deleted()
    {
        $menu_item = factory(MenuItem::class)->state('with-category')->create();
        $this->assertDatabaseHas('menu_items', [
            'id' => $menu_item->id
        ]);

        $this->delete(route('admin.menu-item.destroy', $menu_item->id));
        $this->assertDatabaseMissing('menu_items', [
            'id' => $menu_item->id
        ]);
    }
}
