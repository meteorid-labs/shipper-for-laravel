<?php

namespace Meteor\Shipper\Tests;

use Illuminate\Support\Facades\Http;
use Meteor\Shipper\Shipper;

abstract class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * Set whether to use sandbox or not.
     *
     * @var bool
     */
    protected $useSandbox = true;

    /**
     * @var Shipper
     */
    protected $shipper;

    /**
     * Setup the test environment.
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->shipper = Shipper::make('4yGJ3HbnF4w4mTWhL8BJa62TtGytCsXN5p7AvqXOWLEqjbS5G8Hzv4kYeN3HvtOU');

        if ($this->useSandbox) {
            $this->shipper->useSandbox();
        }
    }

    /**
     * Get package providers.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageProviders($app)
    {
        return [
            \Meteor\Shipper\ShipperServiceProvider::class,
        ];
    }

    /**
     * Get package aliases.
     *
     * @param  \Illuminate\Foundation\Application  $app
     * @return array
     */
    protected function getPackageAliases($app)
    {
        return [
            'Shipper' => \Meteor\Shipper\Facades\Shipper::class,
        ];
    }

    public function fakeResponse($filename)
    {
        $response = file_get_contents(__DIR__.'/responses/'.$filename);

        return Http::response(json_decode($response, true), 200);
    }
}
