<?php

namespace UnitConverter\Converter;

use UnitConverter\Resolver\Query;
use UnitConverter\Unit\Unit;
use UnitConverter\Value\Value;

interface Converter
{
    /**
     * Supported targetUnits
     *
     * @return string[]
     */
    public function supportedUnits();

    /**
     * Check if conversion is available
     *
     * @param Unit $sourceUnit
     * @param Unit $targetUnit
     *
     * @return bool
     */
    public function isSupported(Unit $sourceUnit, Unit $targetUnit);

    /**
     * Execute conversion
     *
     * @param Value $value
     * @param Unit $targetUnit
     *
     * @return Value
     */
    public function convertTo(Value $value, Unit $targetUnit);

    /**
     * @param Query $query
     *
     * @return Value
     */
    public function convertFromQuery(Query $query);
}