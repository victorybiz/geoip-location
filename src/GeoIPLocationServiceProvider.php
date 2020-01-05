<?php

namespace Victorybiz\GeoIPLocation;

use Illuminate\Support\ServiceProvider;

class GeoIPLocationServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //        
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind('geoip-location', function ($app) {
            return new GeoIPLocation(); // Or new \Victorybiz\GeoIPLocation\GeoIPLocation when no proper namespace
        });
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['geoip-location'];
    }
}
