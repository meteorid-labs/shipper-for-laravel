<?php

namespace Meteor\Shipper\Tests\Unit\Console;

use Illuminate\Support\Facades\Schema;
use Meteor\Shipper\Models\Country;
use Meteor\Shipper\Tests\TestCase;

class ImportCountryTest extends TestCase
{
    /** @test */
    public function it_can_import_country()
    {
        $this->artisan('migrate');

        $this->assertTrue(Schema::hasTable($this->prefix.'countries'));

        $this->artisan('shipper:import-country')->assertSuccessful();

        $this->assertDatabaseHas($this->prefix.'countries', [
            'shipper_id' => 1,
            'name' => 'AFGHANISTAN',
            'code' => 'AF',
        ]);

        $countries = Country::all();

        $this->assertTrue($countries->count() > 0);

        $this->artisan('migrate:rollback');
    }
}
