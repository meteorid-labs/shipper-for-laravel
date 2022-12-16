<?php

namespace Meteor\Shipper;

use Illuminate\Support\ServiceProvider;

class ShipperServiceProvider extends ServiceProvider
{
    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->mergeConfigFrom(__DIR__.'/../config/shipper.php', 'meteor.shipper');

        $this->app->singleton('shipper', function ($app) {
            return $app->make(Shipper::class);
        });
    }

    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerMigrations();
        $this->registerPublishing();
        $this->registerCommands();
    }

    /**
     * Register the Passport migration files.
     *
     * @return void
     */
    protected function registerMigrations()
    {
        if ($this->app->runningInConsole() && Shipper::$runsMigrations) {
            $this->loadMigrationsFrom(__DIR__.'/../database/migrations');
        }
    }

    /**
     * Register the package's publishable resources.
     *
     * @return void
     */
    protected function registerPublishing()
    {
        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../database/migrations' => database_path('migrations'),
            ], 'meteor.shipper.migrations');

            $this->publishes([
                __DIR__.'/../config/shipper.php' => config_path('meteor/shipper.php'),
            ], 'meteor.shipper.config');
        }
    }

    /**
     * Register the Shipper Artisan commands.
     *
     * @return void
     */
    protected function registerCommands()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                Console\ImportLogistic::class,
            ]);
        }
    }
}
