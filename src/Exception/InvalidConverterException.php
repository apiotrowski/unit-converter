<?php

namespace UnitConverter\Exception;

class InvalidConverterException extends \Exception
{
    const ERROR_MESSAGE = 'Invalid or Not Found Converter Class: %s';

    public function __construct($converterClass)
    {
        parent::__construct(sprintf(self::ERROR_MESSAGE, $converterClass), 500);
    }
}