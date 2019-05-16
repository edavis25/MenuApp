<?php

namespace Tests\Unit;

use App\Addon;
use App\AddonGroup;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddonGroupTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_addon_group_has_addons()
    {
        $group = factory(AddonGroup::class)->state('with-menu-item')->create();
        $num_addons = 5;
        factory(Addon::class, $num_addons)->create(['addon_group_id' => $group->id]);

        $this->assertInstanceOf(Collection::class, $group->addons);
        $this->assertEquals($num_addons, $group->addons->count());
        $this->assertInstanceOf(Addon::class, $group->addons->first());
    }
}
