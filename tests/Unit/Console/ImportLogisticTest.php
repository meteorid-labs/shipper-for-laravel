<?php

namespace Meteor\Shipper\Tests\Unit\Console;

use Illuminate\Support\Facades\Schema;
use Meteor\Shipper\Models\Logistic;
use Meteor\Shipper\Tests\TestCase;

class ImportLogisticTest extends TestCase
{
    /** @test */
    public function it_can_import_logistic()
    {
        $this->artisan('migrate');

        $this->assertTrue(Schema::hasTable($this->prefix.'logistics'));

        $this->artisan('shipper:import-logistic')->assertSuccessful();

        $this->assertDatabaseHas($this->prefix.'logistics', [
            'name' => 'JNE',
        ]);

        $logistics = Logistic::all();

        $this->assertTrue($logistics->count() > 0);
        $this->assertTrue($logistics->first()->rates->count() > 0);

        $this->artisan('migrate:rollback');
    }
}
