<?php

namespace Meteor\Shipper\Facades;

use Illuminate\Support\Facades\Facade;

class Shipper extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     *
     * @throws \RuntimeException
     */
    protected static function getFacadeAccessor()
    {
        return 'shipper';
    }
}
