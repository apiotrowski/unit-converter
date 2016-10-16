<?php

namespace UnitConverter\Unit;

use UnitConverter\Exception\NotSupportedUnitException;

class UnitFactory
{
    protected static $unitMap = [
        LengthUnit::class,
        WeightUnit::class
    ];

    /**
     * @param string $unitName
     * @return Unit
     * @throws NotSupportedUnitException
     */
    public static function build(string $unitName) : Unit
    {
        foreach (self::$unitMap as $unitClass) {
            try {
                return new $unitClass($unitName);
            } catch (NotSupportedUnitException $e) {
                continue;
            }
        }

        throw new NotSupportedUnitException($unitName);
    }
}