<?php

namespace UnitConverter\Exception;

class NotSupportedUnitException extends \Exception
{
    const ERROR_MESSAGE = 'Not supported unit name: %s';

    public function __construct(string $unitName, $code = 400, \Exception $previous = null)
    {
        parent::__construct(sprintf(static::ERROR_MESSAGE, $unitName), $code, $previous);
    }
}