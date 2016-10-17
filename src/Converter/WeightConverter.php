<?php

namespace UnitConverter\Converter;

use UnitConverter\Exception\NotSupportedConversionException;
use UnitConverter\Resolver\Query;
use UnitConverter\Unit\Unit;
use UnitConverter\Unit\WeightUnit;
use UnitConverter\Value\Value;

class WeightConverter extends BaseConverter implements Converter
{
    /**
     * @inheritdoc
     */
    public function supportedUnits() : array
    {
        return WeightUnit::$unitList;
    }
}