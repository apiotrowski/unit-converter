<?php

namespace UnitConverter\Resolver;

use UnitConverter\Unit\Unit;
use UnitConverter\Value\Value;

class Query
{
    /** @var Value */
    private $value;
    /** @var Unit */
    private $targetUnit;

    /**
     * Query constructor.
     * @param Value $value
     * @param Unit $targetUnit
     */
    public function __construct(Value $value, Unit $targetUnit)
    {
        $this->value = $value;
        $this->targetUnit = $targetUnit;
    }

    /**
     * @return Value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * @return Unit
     */
    public function getTargetUnit()
    {
        return $this->targetUnit;
    }
}