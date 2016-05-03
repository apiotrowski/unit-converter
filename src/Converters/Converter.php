<?php

namespace UnitConverter;

use UnitConverter\Unit\Unit;
use UnitConverter\Value\Value;

interface Converter
{
    /**
     * Supported targetUnits
     *
     * @return Unit[]
     */
    public function supportedUnits();

    /**
     * Execute conversion
     *
     * @param Value $value
     * @param Unit $targetUnit
     *
     * @return Value
     */
    public function convertTo(Value $value, Unit $targetUnit);
}