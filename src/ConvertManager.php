<?php

namespace UnitConverter;

use Doctrine\Common\Collections\Collection;
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
     * @param Converter[]|Collection $converters
     * @param QueryResolver $queryResolver
     */
    public function __construct(Collection $converters, QueryResolver $queryResolver)
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
        $supportedConverters = $this->converters->filter(function (Converter $converter) use ($query) {
            return true === $converter->isSupported($query->getValue()->getUnit(), $query->getTargetUnit());
        });

        if (true === $supportedConverters->isEmpty()) {
            throw new NotSupportedConversionException(
                $query->getValue()->getUnit(),
                $query->getTargetUnit()
            );
        }

        return $supportedConverters->first();
    }
}
