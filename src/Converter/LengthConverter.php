<?php

namespace UnitConverter\Converter;

use UnitConverter\Exception\NotSupportedConversionException;
use UnitConverter\Resolver\Query;
use UnitConverter\Unit\LengthUnit;
use UnitConverter\Unit\Unit;
use UnitConverter\Value\Value;

class LengthConverter extends BaseConverter
{
    /**
     * @inheritdoc
     */
    public function supportedUnits() : array
    {
        return LengthUnit::$unitList;
    }
}