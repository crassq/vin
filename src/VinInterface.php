<?php

namespace CRASSQ\Vin;

interface VinInterface
{
    /** Gets the VIN **/
    public function getVin() : string;

    /** Gets WMI (World Manufacturer Identifier) from the VIN **/
    public function getWmi() : string;

    /** Gets VDS (Vehicle Descriptor Section) from the VIN **/
    public function getVds() : string;

    /** Gets VIS (Vehicle Identifier Section) from the VIN **/
    public function getVis() : string;

    /** Gets a region from the VIN **/
    public function getRegion() : ?string;

    /** Gets a country from the VIN **/
    public function getCountry() : ?string;

    /** Gets a manufacturer from the VIN **/
    public function getManufacturer() : ?string;

    /** Gets a model year from the VIN **/
    public function getModelYear() : array;
}
