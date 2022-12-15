<?php

namespace Meteor\Shipper\Tests;

use Illuminate\Support\Facades\Http;
use Meteor\Shipper\Shipper;

class TestCase extends \Orchestra\Testbench\TestCase
{
    /**
     * The prefix to use for the database tables.
     *
     * @var string
     */
    protected $prefix = 'shipper_';

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
     * Set up the test case.
     *
     * This method is called before each test is run. It creates a new
     * Shipper object and configures it to use the sandbox environment
     * if the `useSandbox` property is `true`.
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->prefix = config('meteor.shipper.database.table_prefix');
        $this->shipper = Shipper::make();

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

    /**
     * Define database migrations.
     *
     * @return void
     */
    protected function defineDatabaseMigrations()
    {
        $this->loadLaravelMigrations();
    }

    /**
     * Fake a response from the Shipper API.
     *
     * @param  string  $filename
     * @return \Illuminate\Support\Facades\Http
     */
    public function fakeResponse(string $filename)
    {
        $response = file_get_contents(__DIR__.'/responses/'.$filename);

        return Http::response(json_decode($response, true), 200);
    }
}
