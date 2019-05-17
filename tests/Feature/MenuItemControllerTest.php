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
            'description' => $menu_item['description'],
            'price' => $menu_item['price'] * 100,
            'category_id' => $menu_item['category_id']
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

    /** @test */
    public function a_user_can_visit_form_to_create_a_menu_item()
    {
        $response = $this->get(route('admin.menu-item.create'));
        $response->assertSuccessful();
    }

    /** @test */
    public function a_user_can_visit_form_to_edit_a_menu_item()
    {
        $menu_item = factory(MenuItem::class)->create();
        $response = $this->get(route('admin.menu-item.edit', $menu_item->id));
        $response->assertSuccessful();
        $response->assertViewHas(['categories', 'menu_item']);
    }

    /** @test */
    public function a_user_can_view_a_listing_of_menu_items()
    {
        factory(MenuItem::class, 5)->create();
        $response = $this->get(route('admin.menu-item.index'));
        $response->assertSuccessful();
        $response->assertViewHas('menu_items');
    }
}
