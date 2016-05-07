<?php

namespace UnitConverter\Unit;

use UnitConverter\Exception\NotSupportedUnitException;

class LengthUnit extends AbstractUnit
{
    public static $unitList = [
        Unit::CM, 
        Unit::IN,
        Unit::FT
    ];

    protected static $convertUnitMap = [
        self::CM => '1', self::IN => '0.393', self::FT => '0.0328084'
    ];

    /**
     * LengthUnit constructor.
     * @param string $unitName
     * @throws NotSupportedUnitException
     */
    public function __construct(string $unitName)
    {
        if (!in_array($unitName, self::$unitList)) {
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