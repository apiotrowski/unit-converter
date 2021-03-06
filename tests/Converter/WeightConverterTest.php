<?php

namespace UnitConverter\Tests\Converter;

use PHPUnit\Framework\TestCase;
use UnitConverter\Converter\WeightConverter;
use UnitConverter\Unit\LengthUnit;
use UnitConverter\Unit\Unit;
use UnitConverter\Unit\UnitFactory;
use UnitConverter\Unit\WeightUnit;
use UnitConverter\Value\Value;

class WeightConverterTest extends TestCase
{
    /**
     * @expectedException \UnitConverter\Exception\NotSupportedConversionException
     *
     * @throws \UnitConverter\Exception\NotSupportedUnitException
     */
    public function testConvertToThrowNotSupportedConversionExceptionWhenDifferentUnitType()
    {
        $converter = new WeightConverter();
        $converter->convertTo(new Value(10, UnitFactory::build(WeightUnit::KILOGRAM)), UnitFactory::build(LengthUnit::METER));
    }

    /**
     * @dataProvider convertDataProvider
     *
     * @param Value $value
     * @param Unit $targetUnit
     * @param string $expectedValue
     *
     * @throws \UnitConverter\Exception\NotSupportedConversionException
     */
    public function testConvertToReturnValueWhenSuccess(Value $value, Unit $targetUnit, string $expectedValue)
    {
        $converter = new WeightConverter();
        $convertedValue = $converter->convertTo($value, $targetUnit);

        $this->assertInstanceOf(Value::class, $convertedValue);
        $this->assertEquals($expectedValue, $convertedValue->getValue());
    }

    /**
     * @return array
     *
     * @throws \UnitConverter\Exception\NotSupportedUnitException
     */
    public function convertDataProvider()
    {
        return [
            [ new Value(10, UnitFactory::build(WeightUnit::KILOGRAM)), UnitFactory::build(WeightUnit::TONNE), '0.01' ],
            [ new Value(1, UnitFactory::build(WeightUnit::TONNE)), UnitFactory::build(WeightUnit::POUNDS), '2204.62' ],
        ];
    }
}
