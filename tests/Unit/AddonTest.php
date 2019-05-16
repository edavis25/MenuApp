<?php

namespace Tests\Unit;

use App\Addon;
use App\AddonGroup;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddonTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_addon_belongs_to_a_group()
    {
        $addon = factory(Addon::class)->state('with-group')->create();
        $this->assertInstanceOf(AddonGroup::class, $addon->addonGroup);
    }
}
