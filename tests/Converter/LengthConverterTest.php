<?php

namespace UnitConverter\Converter;

use UnitConverter\Unit\Unit;
use UnitConverter\Unit\UnitFactory;
use UnitConverter\Value\Value;

class LengthConverterTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @expectedException \UnitConverter\Exception\NotSupportedUnitException
     */
    public function testConvertToThrowNotSupportedConversionExceptionWhenDifferentUnitType()
    {
        $converter = new LengthConverter();
        $converter->convertTo(new Value(10, UnitFactory::build(Unit::CM)), UnitFactory::build(Unit::SECOND));
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
            [ new Value(10, UnitFactory::build(Unit::CM)), UnitFactory::build(Unit::IN), '3.93' ],
            [ new Value(10, UnitFactory::build(Unit::IN)), UnitFactory::build(Unit::CM), '25.445' ]
        ];
    }
}