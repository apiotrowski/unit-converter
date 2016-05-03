<?php

namespace UnitConverter\Exception;

class NotSupportedUnitException extends \Exception
{
    public function __construct($message = '', $code = 400, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}