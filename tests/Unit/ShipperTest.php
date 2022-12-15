<?php

namespace Meteor\Shipper\Tests\Unit;

use Meteor\Shipper\Shipper;
use Meteor\Shipper\Tests\TestCase;

class ShipperTest extends TestCase
{
    /** @test */
    public function it_can_be_instantiated()
    {
        $this->assertInstanceOf(Shipper::class, $this->shipper);
    }

    /** @test */
    public function it_can_be_instantiated_using_the_facade()
    {
        $this->assertInstanceOf(Shipper::class, Shipper::make());
    }

    /** @test */
    public function it_contains_the_correct_properties()
    {
        $this->assertClassHasAttribute('apiKey', Shipper::class);
        $this->assertClassHasAttribute('apiUrl', Shipper::class);
    }

    /** @test */
    public function it_contains_the_correct_methods()
    {
        $this->assertTrue(method_exists(Shipper::class, '__construct'));
        $this->assertTrue(method_exists(Shipper::class, 'make'));
        $this->assertTrue(method_exists(Shipper::class, 'getApiUrl'));
        $this->assertTrue(method_exists(Shipper::class, 'useSandbox'));
        $this->assertTrue(method_exists(Shipper::class, 'getApiKey'));
        $this->assertTrue(method_exists(Shipper::class, 'setApiKey'));
    }

    /** @test */
    public function it_can_set_the_api_key()
    {
        $this->shipper->setApiKey('foo');
        $this->assertEquals('foo', $this->shipper->getApiKey());
    }

    /** @test */
    public function it_can_use_the_sandbox_environment()
    {
        $this->shipper->useSandbox();
        $this->assertEquals('https://merchant-api-sandbox.shipper.id', $this->shipper->getApiUrl());
    }

    /** @test */
    public function it_can_use_the_production_environment()
    {
        $this->shipper->useSandbox();
        $this->shipper->useProduction();

        $this->assertEquals('https://merchant-api.shipper.id', $this->shipper->getApiUrl());
    }
}
