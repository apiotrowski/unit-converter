<?php

namespace UnitConverter;

use UnitConverter\Converter\Converter;
use UnitConverter\Exception\InvalidConverterException;
use UnitConverter\Exception\NotSupportedConversionException;
use UnitConverter\Exception\NotSupportedUnitException;
use UnitConverter\Resolver\Query;
use UnitConverter\Resolver\QueryResolver;
use UnitConverter\Value\Value;

class ConvertManager
{
    /** @var Converter[]  */
    private $converters;

    /** @var QueryResolver */
    private $resolver;

    /**
     * ConvertManager constructor.
     * @param string[] $converterClassList
     */
    public function __construct(array $converterClassList)
    {
        $this->converters = $this->initConverters($converterClassList);
        $this->resolver = new QueryResolver();
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
        $query = $this->resolver->resolve($rawQuery);

        $converter = $this->getSupportedConverter($query);
        
        return $converter->convertFromQuery($query);
    }

    /**
     * @param array $converterClass
     * @return array
     */
    protected function initConverters(array $converterClass) : array
    {
        return array_map(function($converterClass) {
            if (!class_exists($converterClass)) {
                throw new InvalidConverterException($converterClass);
            }
            return new $converterClass();
        }, $converterClass);
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