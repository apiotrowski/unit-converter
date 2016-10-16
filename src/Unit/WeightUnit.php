<?php

namespace UnitConverter\Unit;

use UnitConverter\Exception\NotSupportedUnitException;

class WeightUnit extends AbstractUnit
{
    const TONNE = 't';
    const KILOGRAM = 'kg';
    const GRAM = 'g';
    const DECAGRAMME = 'dag';
    const POUNDS = 'lbs';
    const OUNCE = 'oz';

    public static $unitList = [
        self::TONNE,
        self::KILOGRAM,
        self::DECAGRAMME,
        self::GRAM,
        self::POUNDS,
        self::OUNCE,
    ];

    protected static $convertUnitMap = [
        self::TONNE => '0.001',
        self::KILOGRAM => '1',
        self::DECAGRAMME => '100',
        self::GRAM => '1000',
        self::POUNDS => '2.20462',
        self::OUNCE => '35.274',
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