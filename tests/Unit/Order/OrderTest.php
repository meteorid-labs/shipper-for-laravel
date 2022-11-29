<?php

namespace Meteor\Shipper\Tests\Unit\Order;

use Meteor\Shipper\Api\Order\Order;
use Meteor\Shipper\Tests\TestCase;

class OrderTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Order::class, $this->shipper->order());
    }

    /** @test */
    public function it_contains_the_correct_methods()
    {
        $this->assertTrue(method_exists(Order::class, '__construct'));
        $this->assertTrue(method_exists(Order::class, 'create'));
        $this->assertTrue(method_exists(Order::class, 'detail'));
        $this->assertTrue(method_exists(Order::class, 'trackingStatus'));
        $this->assertTrue(method_exists(Order::class, 'cancel'));
        $this->assertTrue(method_exists(Order::class, 'availableOrders'));
        $this->assertTrue(method_exists(Order::class, 'update'));
        $this->assertTrue(method_exists(Order::class, 'cancel'));
    }
}
