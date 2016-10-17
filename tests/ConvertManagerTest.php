<?php

namespace UnitConverter;

use UnitConverter\Converter\LengthConverter;
use UnitConverter\Converter\WeightConverter;
use UnitConverter\Tests\Converters\InvalidConverter;
use UnitConverter\Value\Value;

class ConvertManagerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @dataProvider rawQueryProvider
     *
     * @param string $rawQuery
     */
    public function testConvertReturnConvertedValue(string $rawQuery)
    {
        $convertManager = new ConvertManager([
            LengthConverter::class,
            WeightConverter::class
        ]);

        $convertedValue = $convertManager->convert($rawQuery);

        $this->assertInstanceOf(Value::class, $convertedValue);
    }

    /**
     * @expectedException \UnitConverter\Exception\InvalidConverterException
     */
    public function testConverterManagerThrowInvalidConverterExceptionWhenConverterInvalid()
    {
        new ConvertManager([
            LengthConverter::class,
            'ClassNotExists::class'
        ]);
    }

    /**
     * @expectedException \LogicException
     */
    public function testConvertManagerThrowLogicExceptionWhenUserTryToUseConverterWhatNotImplementConverterInterface()
    {
        new ConvertManager([InvalidConverter::class]);
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