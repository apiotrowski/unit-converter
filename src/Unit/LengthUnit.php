<?php

namespace UnitConverter\Unit;

use UnitConverter\Exception\NotSupportedUnitException;

class LengthUnit extends AbstractUnit
{
    const KILOMETER = 'km';
    const MILE = 'mi';
    const METER = 'm';
    const CENTIMETRE = 'cm';
    const INCH = 'in';
    const FOOT = 'ft';

    public static $unitList = [
        self::KILOMETER,
        self::METER,
        self::CENTIMETRE,
        self::INCH,
        self::FOOT
    ];

    protected static $convertUnitMap = [
        self::METER => '0.01',
        self::CENTIMETRE => '1',
        self::INCH => '0.393',
        self::FOOT => '0.0328084'
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
