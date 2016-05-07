<?php

namespace UnitConverter;

use UnitConverter\Exception\NotSupportedUnitException;
use UnitConverter\Resolver\QueryResolver;
use UnitConverter\Value\Value;

class ConvertManager
{
    /** @var Converter[] */
    private $converters;

    /** @var QueryResolver */
    private $resolver;

    /**
     * ConvertManager constructor.
     * @param Converter[] $converters
     * @param QueryResolver $resolver
     */
    public function __construct(array $converters, QueryResolver $resolver)
    {
        $this->converters = $converters;
        $this->resolve = $resolver;
    }

    /**
     * @param string $rawQuery
     *
     * @return Value
     *
     * @throws NotSupportedUnitException
     */
    public function convert(string $rawQuery) : Value
    {

    }
}