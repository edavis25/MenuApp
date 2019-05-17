<?php

namespace Tests\Feature;

use App\Addon;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddonControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function an_addon_can_be_created()
    {
        $addon = factory(Addon::class)->state('with-group')->raw();
        $this->post(route('admin.addon.store', $addon['addon_group_id']), $addon);
        $this->assertDatabaseHas('addons', [
            'name' => $addon['name'],
            'price' => $addon['price'] * 100,
            'addon_group_id' => $addon['addon_group_id']
        ]);
    }

    /** @test */
    public function a_name_is_required_for_creating_an_addon()
    {
        $addon = factory(Addon::class)->state('with-group')->raw(['name' => null]);
        $response = $this->post(route('admin.addon.store', $addon['addon_group_id']), $addon);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function an_addon_can_be_updated()
    {
        $addon = factory(Addon::class)->state('with-group')->create();
        $addon_array = factory(Addon::class)->raw();
        $this->put(route('admin.addon.update', $addon->id), $addon_array);
        $this->assertDatabaseHas('addons', [
            'name' => $addon_array['name'],
            'price' => $addon_array['price'] * 100
        ]);
    }

    /** @test */
    public function a_name_is_required_for_updating_an_addon()
    {
        $addon = factory(Addon::class)->state('with-group')->create();
        $addon_array = factory(Addon::class)->raw(['name' => null]);
        $response = $this->put(route('admin.addon.update', $addon->id), $addon_array);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function an_addon_can_be_deleted()
    {
        $addon = factory(Addon::class)->state('with-group')->create();
        $this->assertDatabaseHas('addons', [
            'id' => $addon->id
        ]);
        $this->delete(route('admin.menu-item.destroy', $addon->id));
        $this->assertDatabaseMissing('addons', [
            'id' => $addon->id
        ]);
    }
}
