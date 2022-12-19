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
     * @var Shipper
     */
    protected $shipper;

    /**
     * Set up the test case.
     *
     * This method is called before each test is run. It creates a new Shipper
     *
     * @return void
     */
    protected function setUp(): void
    {
        parent::setUp();

        $this->prefix = config('meteor.shipper.database.table_prefix');
        $this->shipper = Shipper::make();
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
