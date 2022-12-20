<?php

namespace Meteor\Shipper\Tests;

class HelperTest extends \Meteor\Shipper\Tests\TestCase
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

    /** @test */
    public function it_can_format_phone_number()
    {
        $phone = shipper_phone_format('081234567890');
        $phone2 = shipper_phone_format('+6281234567890');

        $this->assertEquals('81234567890', $phone);
        $this->assertEquals('6281234567890', $phone2);
    }
}
