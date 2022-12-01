<?php

namespace Meteor\Shipper\Tests\Feature;

use Meteor\Shipper\ShipperServiceProvider;
use Meteor\Shipper\Tests\TestCase;

class ShipperServiceProviderTest extends TestCase
{
    public function testRegister()
    {
        $app = $this->createApplication();
        $app->register(ShipperServiceProvider::class);

        $this->assertTrue($app->bound('shipper'));
    }

    // public function testBoot()
    // {
    //     $app = $this->createApplication();
    //     $app->register(ShipperServiceProvider::class);

    //     $this->assertFileExists(config_path('meteor/shipper.php'));
    // }
}
