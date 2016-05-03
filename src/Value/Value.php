<?php

namespace UnitConverter\Value;

use UnitConverter\Unit\Unit;

class Value
{
    /** @var string */
    private $value;

    /** @var Unit */
    private $unit;

    /**
     * Value constructor.
     * @param string $value
     * @param Unit $unit
     */
    public function __construct($value, Unit $unit)
    {
        $this->value = $value;
        $this->unit = $unit;
    }

    /**
     * @return string
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return string
     */
    public function getUnit()
    {
        return $this->unit;
    }
}