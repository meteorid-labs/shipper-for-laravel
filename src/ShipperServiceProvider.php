<?php

namespace Meteor\Shipper;

class ShipperServiceProvider extends \Illuminate\Support\ServiceProvider
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
        $this->loadMigrationsFrom(__DIR__.'/../database/migrations');

        if ($this->app->runningInConsole()) {
            $this->publishes([
                __DIR__.'/../config/shipper.php' => config_path('meteor/shipper.php'),
            ], 'meteor.shipper.config');

            $this->publishes([
                __DIR__.'/../database/migrations/' => database_path('migrations'),
            ], 'meteor.shipper.migrations');

            $this->commands([
                Console\ImportLogistic::class,
            ]);
        }
    }
}
