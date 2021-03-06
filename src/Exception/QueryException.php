<?php

namespace UnitConverter\Exception;

class QueryException extends \Exception
{
    public function __construct(string $message, $code = 400, \Exception $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
