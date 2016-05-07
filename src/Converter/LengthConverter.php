<?php

namespace UnitConverter\Converter;

use UnitConverter\Exception\NotSupportedConversionException;
use UnitConverter\Unit\LengthUnit;
use UnitConverter\Unit\Unit;
use UnitConverter\Value\Value;

class LengthConverter extends BaseConverter
{
    /**
     * @return array
     */
    public function supportedUnits()
    {
        return LengthUnit::$unitList;
    }

    /**
     * @param Value $value
     * @param Unit $targetUnit
     *
     * @return Value
     *
     * @throws NotSupportedConversionException
     */
    public function convertTo(Value $value, Unit $targetUnit)
    {
        if (false === $this->isSupported($value->getUnit(), $targetUnit)) {
            throw new NotSupportedConversionException($value->getUnit(), $targetUnit);
        }

        $conversionMap = $targetUnit->getConvertUnitMap();
        $mapValue = $conversionMap[(string)$value->getUnit()];
        $mapTargetValue = $conversionMap[(string)$targetUnit];

        $convertedValue = bcdiv(bcmul($value->getValue(), $mapTargetValue, 3), $mapValue, 3);

        return new Value($convertedValue, $targetUnit);
    }
}