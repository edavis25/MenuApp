<?php

namespace Tests\Feature;

use App\Category;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function a_user_can_view_a_listing_of_categories()
    {
        factory(Category::class, 5)->create();
        $response = $this->get(route('admin.category.index'));
        $response->assertSuccessful();
        $response->assertViewHas('categories');
    }

    /** @test */
    public function a_user_can_view_form_for_creating_category()
    {
        $response = $this->get(route('admin.category.create'));
        $response->assertSuccessful();
    }

    /** @test */
    public function a_user_can_view_form_for_editing_category()
    {
        $category = factory(Category::class)->create();
        $response = $this->get(route('admin.category.edit', $category->id));
        $response->assertSuccessful();
        $response->assertViewHas('category');
    }

    /** @test */
    public function can_create_a_new_category()
    {
        $category_array = factory(Category::class)->raw();
        $this->post(route('admin.category.store', $category_array));
        $this->assertDatabaseHas('categories', [
            'name' => $category_array['name'],
            'description' => $category_array['description']
        ]);
    }

    /** @test */
    public function a_name_is_required_for_creating_category()
    {
        $category_array = factory(Category::class)->raw(['name' => null]);
        $response = $this->post(route('admin.category.store', $category_array));
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function a_category_can_be_updated()
    {
        $category = factory(Category::class)->create();
        $category_array = factory(Category::class)->raw();
        $this->put(route('admin.category.update', $category->id), $category_array);
        $this->assertDatabaseHas('categories', [
            'name' => $category_array['name'],
            'description' => $category_array['description']
        ]);
    }

    /** @test */
    public function a_name_is_required_for_updating_a_category()
    {
        $category = factory(Category::class)->create();
        $category_array = factory(Category::class)->raw(['name' => null]);
        $response = $this->put(route('admin.category.update', $category->id), $category_array);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function a_category_can_be_deleted()
    {
        $category = factory(Category::class)->create();
        $this->assertDatabaseHas('categories', [
            'id' => $category->id
        ]);
        $this->delete(route('admin.category.destroy', $category->id));
        $this->assertDatabaseMissing('categories', [
            'id' => $category->id
        ]);
    }
}
