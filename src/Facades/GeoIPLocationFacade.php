<?php

namespace Victorybiz\GeoIPLocation\Facades;

use Illuminate\Support\Facades\Facade;

class GeoIPLocationFacade extends Facade
{
    /**
     * Get the registered name / binding of the component
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'geoip-location'; // the IoC container binding name registered in Service Provider 
    }
}