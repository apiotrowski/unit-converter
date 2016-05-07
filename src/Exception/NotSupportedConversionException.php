<?php

namespace UnitConverter\Exception;

use UnitConverter\Unit\Unit;

class NotSupportedConversionException extends \Exception
{
    const ERROR_MESSAGE = 'Not supported Conversion %s to %s';

    public function __construct(Unit $valueUnit, Unit $targetUnit)
    {
        parent::__construct(sprintf(
            static::ERROR_MESSAGE,
            $valueUnit->getName(),
            $targetUnit->getName()
        ));
    }
}