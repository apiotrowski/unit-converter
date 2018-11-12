<?php

namespace UnitConverter\Converter;

use UnitConverter\Exception\NotSupportedConversionException;
use UnitConverter\Resolver\Query;
use UnitConverter\Unit\Unit;
use UnitConverter\Value\Value;

abstract class BaseConverter
{
    /**
     * @inheritdoc
     */
    abstract function supportedUnits();

    /**
     * @inheritdoc
     */
    public function isSupported(Unit $sourceUnit, Unit $targetUnit) : bool
    {
        if (false === in_array($sourceUnit->getName(), $this->supportedUnits()) || false === in_array($targetUnit->getName(), $this->supportedUnits())) {
            return false;
        }
        return true;
    }

    /**
     * @inheritdoc
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
     * @inheritdoc
     *
     * @throws NotSupportedConversionException
     */
    public function convertFromQuery(Query $query) : Value
    {
        return $this->convertTo($query->getValue(), $query->getTargetUnit());
    }

    /**
     * @inheritdoc
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
