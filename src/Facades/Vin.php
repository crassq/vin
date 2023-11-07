<?php

namespace Crassq\Vin\Facades;

use Illuminate\Support\Facades\Facade;

/**
 * @method static bool validate(string $vin)
 * @method static array parse(string $vin)
 * @method static string getVin(string $vin = null)
 * @method static string getWmi(string $vin = null)
 * @method static string getVds(string $vin = null)
 * @method static string getVis(string $vin = null)
 * @method static string getManufacturer(string $vin = null)
 * @method static array getModelYear(string $vin = null)
 * @method static string getRegion(string $vin = null)
 * @method static string getCountry(string $vin = null)
 * @method static array toArray(string $vin = null)
 */
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
