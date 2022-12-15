<?php

namespace Meteor\Shipper\Tests\Unit;

use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Schema;
use Meteor\Shipper\Tests\TestCase;

/**
 * @group migrations
 */
class MigrationTest extends TestCase
{
    /** @test */
    public function all_migrations_can_run_rollback()
    {
        $this->artisan('migrate');

        $this->assertTrue(Schema::hasTable($this->prefix.'logistics'));

        $migrationsList = collect(File::allFiles(
            __DIR__.'/../../database/migrations'
        ))->map(fn ($file) => pathinfo($file->getFilename(), PATHINFO_FILENAME));

        foreach ($migrationsList as $migration) {
            $this->assertDatabaseHas('migrations', [
                'migration' => $migration,
            ]);
        }

        $this->artisan('migrate:rollback');

        $this->assertTrue(Schema::hasTable($this->prefix.'logistics') === false);
    }

    /** @test */
    public function each_migration_can_run_and_rollback()
    {
        $migrationsList = collect(File::allFiles(
            __DIR__.'/../../database/migrations'
        ));

        foreach ($migrationsList as $migration) {
            $this->artisan('migrate', [
                '--realpath' => $migration->getRealpath(),
            ]);

            $this->assertDatabaseHas('migrations', [
                'migration' => pathinfo($migration->getFilename(), PATHINFO_FILENAME),
            ]);

            $this->artisan('migrate:rollback', [
                '--realpath' => $migration->getRealpath(),
            ]);

            $this->assertDatabaseMissing('migrations', [
                'migration' => pathinfo($migration->getFilename(), PATHINFO_FILENAME),
            ]);

            $this->artisan('migrate', [
                '--realpath' => $migration->getRealpath(),
            ]);
        }
    }
}
