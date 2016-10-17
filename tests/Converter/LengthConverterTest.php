<?php

namespace UnitConverter\Tests\Converter;

use UnitConverter\Converter\LengthConverter;
use UnitConverter\Unit\LengthUnit;
use UnitConverter\Unit\Unit;
use UnitConverter\Unit\UnitFactory;
use UnitConverter\Unit\WeightUnit;
use UnitConverter\Value\Value;

class LengthConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \UnitConverter\Exception\NotSupportedConversionException
     */
    public function testConvertToThrowNotSupportedConversionExceptionWhenDifferentUnitType()
    {
        $converter = new LengthConverter();
        $converter->convertTo(new Value(10, UnitFactory::build(LengthUnit::CENTIMETRE)), UnitFactory::build(WeightUnit::KILOGRAM));
    }

    /**
     * @dataProvider convertDataProvider
     *
     * @param Value $value
     * @param Unit $targetUnit
     * @param string $expectedValue
     */
    public function testConvertToReturnValueWhenSuccess(Value $value, Unit $targetUnit, string $expectedValue)
    {
        $converter = new LengthConverter();
        $convertedValue = $converter->convertTo($value, $targetUnit);

        $this->assertInstanceOf(Value::class, $convertedValue);
        $this->assertEquals($expectedValue, $convertedValue->getValue());
    }

    public function convertDataProvider()
    {
        return [
            [ new Value(10, UnitFactory::build(LengthUnit::CENTIMETRE)), UnitFactory::build(LengthUnit::INCH), '3.93' ],
            [ new Value(10, UnitFactory::build(LengthUnit::INCH)), UnitFactory::build(LengthUnit::CENTIMETRE), '25.44' ]
        ];
    }
}