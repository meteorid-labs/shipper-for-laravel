<?php

namespace Meteor\Shipper\Tests;

use Meteor\Shipper\Tests\TestCase;

class HelperTest extends TestCase
{
    /** @test */
    public function it_can_get_shipper_rates()
    {
        $rates = shipper_rates();

        $this->assertTrue(count($rates) > 0);
    }

    /** @test */
    public function it_can_get_shipper_categories()
    {
        $categories = shipper_categories();

        $this->assertTrue(count($categories) > 0);
    }
}
