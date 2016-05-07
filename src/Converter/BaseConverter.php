<?php

namespace UnitConverter\Converter;

use UnitConverter\Unit\Unit;

abstract class BaseConverter implements Converter
{
    /**
     * @param Unit $sourceUnit
     * @param Unit $targetUnit
     * 
     * @return bool
     */
    public function isSupported(Unit $sourceUnit, Unit $targetUnit)
    {
        if (!in_array($sourceUnit->getName(), $this->supportedUnits()) || !in_array($targetUnit->getName(), $this->supportedUnits())) {
            return false;
        }
        return true;
    }
}