<?php

namespace UnitConverter;

use UnitConverter\Exception\NotSupportedUnitException;
use UnitConverter\Resolver\QueryResolver;

class ConvertManager
{
    /** @var Converter[] */
    private $converters;

    /** @var QueryResolver */
    private $resolve;

    /**
     * ConvertManager constructor.
     * @param Converter[] $converters
     * @param QueryResolver $resolve
     */
    public function __construct(array $converters, QueryResolver $resolve)
    {
        $this->converters = $converters;
        $this->resolve = $resolve;
    }

    /**
     * @param $query
     *
     * @return string
     *
     * @throws NotSupportedUnitException
     */
    public function convert($query)
    {

    }
}