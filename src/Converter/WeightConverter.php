<?php

namespace UnitConverter\Converter;

use UnitConverter\Exception\NotSupportedConversionException;
use UnitConverter\Resolver\Query;
use UnitConverter\Unit\Unit;
use UnitConverter\Unit\WeightUnit;
use UnitConverter\Value\Value;

class WeightConverter extends BaseConverter
{
    /**
     * @return array
     */
    public function supportedUnits() : array
    {
        return WeightUnit::$unitList;
    }

    /**
     * @param Value $value
     * @param Unit $targetUnit
     *
     * @return Value
     *
     * @throws NotSupportedConversionException
     */
    public function convertTo(Value $value, Unit $targetUnit) : Value
    {
        if (false === $this->isSupported($value->getUnit(), $targetUnit)) {
            throw new NotSupportedConversionException($value->getUnit(), $targetUnit);
        }

        return $this->calculateValue($value, $targetUnit);
    }

    /**
     * @param Query $query
     *
     * @return Value
     *
     * @throws NotSupportedConversionException
     */
    public function convertFromQuery(Query $query) : Value
    {
        return $this->convertTo($query->getValue(), $query->getTargetUnit());
    }

    /**
     * @param Value $value
     * @param Unit $targetUnit
     *
     * @return Value
     */
    protected function calculateValue(Value $value, Unit $targetUnit) : Value
    {
        $conversionMap = $targetUnit->getConvertUnitMap();

        $valueToConvert = $value->getValue();
        $valueUnitValue = $conversionMap[(string)$value->getUnit()];
        $targetUnitValue = $conversionMap[(string)$targetUnit];

        $convertedValue = bcdiv(bcmul($valueToConvert, $targetUnitValue, 5), $valueUnitValue, 2);

        return new Value($convertedValue, $targetUnit);
    }
}