<?php

namespace UnitConverter\Unit;

use UnitConverter\Exception\NotSupportedUnitException;

class LengthUnit extends AbstractUnit
{
    protected static $supportedUnit = [
        Unit::CM, Unit::IN
    ];

    protected static $convertUnitMap = [
        [ self::CM => 1, self::IN => 0.393 ]
    ];

    /**
     * LengthUnit constructor.
     * @param string $unitName
     * @throws NotSupportedUnitException
     */
    public function __construct(string $unitName)
    {
        if (!in_array($unitName, self::$supportedUnit)) {
            throw new NotSupportedUnitException($unitName);
        }

        $this->name = $unitName;
    }

    /**
     * @return array
     */
    public function getConvertUnitMap() : array
    {
        return self::$convertUnitMap;
    }
}