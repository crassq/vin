<?php

namespace CRASSQ\Vin\Facades;

use Illuminate\Support\Facades\Facade;

class Vin extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return 'vin';
    }
}
