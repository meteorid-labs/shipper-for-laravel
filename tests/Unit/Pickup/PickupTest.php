<?php

namespace Meteor\Shipper\Tests\Unit\Pickup;

use Meteor\Shipper\Api\Pickup\Pickup;
use Meteor\Shipper\Tests\TestCase;

class PickupTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Pickup::class, $this->shipper->pickup());
    }

    /** @test */
    public function it_contains_the_correct_methods()
    {
        $this->assertTrue(method_exists(Pickup::class, '__construct'));
        $this->assertTrue(method_exists(Pickup::class, 'create'));
        $this->assertTrue(method_exists(Pickup::class, 'cancel'));
        $this->assertTrue(method_exists(Pickup::class, 'createWithTimeslot'));
        $this->assertTrue(method_exists(Pickup::class, 'getTimeslot'));
    }
}
