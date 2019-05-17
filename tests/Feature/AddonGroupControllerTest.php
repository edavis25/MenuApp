<?php

namespace Tests\Feature;

use App\AddonGroup;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddonGroupControllerTest extends TestCase
{
    use RefreshDatabase, WithoutMiddleware;

    /** @test */
    public function an_addon_group_can_be_created()
    {
        $group = factory(AddonGroup::class)->state('with-menu-item')->raw();
        $this->post(route('admin.addon-group.store', $group['menu_item_id']), $group);
        $this->assertDatabaseHas('addon_groups', [
            'name' => $group['name'],
            'description' => $group['description'],
            'exclusive' => $group['exclusive'],
            'required' => $group['required']
        ]);
    }

    /** @test */
    public function a_name_is_required_for_creating_an_addon_group()
    {
        $group = factory(AddonGroup::class)->state('with-menu-item')->raw(['name' => null]);
        $response = $this->post(route('admin.addon-group.store', $group['menu_item_id']), $group);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function an_addon_group_can_be_updated()
    {
        $group = factory(AddonGroup::class)->state('with-menu-item')->create();
        $group_array = factory(AddonGroup::class)->raw();
        $this->put(route('admin.addon-group.update', $group->id), $group_array);
        $this->assertDatabaseHas('addon_groups', [
            'name' => $group_array['name'],
            'description' => $group_array['description'],
            'exclusive' => $group_array['exclusive'],
            'required' => $group_array['required']
        ]);
    }

    /** @test */
    public function a_name_is_required_for_updating_an_addon_group()
    {
        $group = factory(AddonGroup::class)->state('with-menu-item')->create();
        $group_array = factory(AddonGroup::class)->raw(['name' => null]);
        $response = $this->put(route('admin.addon-group.update', $group->id), $group_array);
        $response->assertSessionHasErrors();
    }

    /** @test */
    public function an_addon_group_can_be_deleted()
    {
        $group = factory(AddonGroup::class)->state('with-menu-item')->create();
        $this->assertDatabaseHas('addon_groups', [
            'id' => $group->id
        ]);
        $this->delete(route('admin.addon-group.destroy', $group->id));
        $this->assertDatabaseMissing('addon_groups', [
            'id' => $group->id
        ]);
    }
}
