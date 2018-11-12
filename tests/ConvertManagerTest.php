<?php

namespace UnitConverter;

use PHPUnit\Framework\TestCase;
use UnitConverter\Converter\LengthConverter;
use UnitConverter\Converter\WeightConverter;
use UnitConverter\Resolver\QueryResolver;
use UnitConverter\Value\Value;

class ConvertManagerTest extends TestCase
{
    /**
     * @dataProvider rawQueryProvider
     *
     * @param string $rawQuery
     * @throws Exception\NotSupportedConversionException
     * @throws Exception\NotSupportedUnitException
     * @throws Exception\QueryException
     */
    public function testConvertReturnConvertedValue(string $rawQuery)
    {
        $convertManager = new ConvertManager([
            new LengthConverter(),
            new WeightConverter()
        ], new QueryResolver());

        $convertedValue = $convertManager->convert($rawQuery);

        $this->assertInstanceOf(Value::class, $convertedValue);
    }

    public function rawQueryProvider()
    {
        return [
            ['10cm to in'],
            ['10cm to ft'],
            ['1kg to t']
        ];
    }
}
