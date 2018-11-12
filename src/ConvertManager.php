<?php

namespace UnitConverter;

use UnitConverter\Converter\Converter;
use UnitConverter\Exception\NotSupportedConversionException;
use UnitConverter\Exception\NotSupportedUnitException;
use UnitConverter\Resolver\Query;
use UnitConverter\Resolver\QueryResolver;
use UnitConverter\Value\Value;

class ConvertManager
{
    /**
     * @var Converter[]
     */
    private $converters;

    /**
     * @var QueryResolver
     */
    private $queryResolver;

    /**
     * @param Converter[] $converters
     * @param QueryResolver $queryResolver
     */
    public function __construct(array $converters, QueryResolver $queryResolver)
    {
        $this->converters = $converters;
        $this->queryResolver = $queryResolver;
    }

    /**
     * @param string $rawQuery
     *
     * @return Value
     *
     * @throws Exception\QueryException
     * @throws NotSupportedConversionException
     * @throws NotSupportedUnitException
     */
    public function convert(string $rawQuery) : Value
    {
        $query = $this->queryResolver->resolve($rawQuery);

        $converter = $this->getSupportedConverter($query);
        
        return $converter->convertFromQuery($query);
    }

    /**
     * @param Query $query
     *
     * @return Converter
     *
     * @throws NotSupportedConversionException
     */
    protected function getSupportedConverter(Query $query) : Converter
    {
        $valueUnit = $query->getValue()->getUnit();
        $targetUnit = $query->getTargetUnit();

        foreach ($this->converters as $converter) {
            if (true === $converter->isSupported($valueUnit, $targetUnit)) {
                return $converter;
            }
        }

        throw new NotSupportedConversionException($valueUnit, $targetUnit);
    }
}
