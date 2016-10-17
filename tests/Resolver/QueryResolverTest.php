<?php

namespace UnitConverter\Tests\Resolver;

use UnitConverter\Resolver\Query;
use UnitConverter\Resolver\QueryResolver;
use UnitConverter\Unit\LengthUnit;
use UnitConverter\Unit\UnitFactory;
use UnitConverter\Value\Value;

class QueryResolverTest extends \PHPUnit_Framework_TestCase
{
    /** @var QueryResolver */
    private $queryResolver;

    public function setUp()
    {
        $this->queryResolver = new QueryResolver();
    }

    /**
     * @dataProvider availableQuery
     *
     * @param string $rawQuery
     * @param Query $expectedQuery
     */
    public function testResolveMethodReturnValueAndTarget(string $rawQuery, Query $expectedQuery)
    {
        $query = $this->queryResolver->resolve($rawQuery);
        $this->assertInstanceOf(Query::class, $query);
        $this->assertInstanceOf(LengthUnit::class, $query->getTargetUnit());
        $this->assertEquals(10, $query->getValue()->getValue());
        $this->assertEquals($expectedQuery, $query);
    }

    public function availableQuery()
    {
        return [
            [ '10cm to ?in', new Query(new Value(10, UnitFactory::build(LengthUnit::CENTIMETRE)), UnitFactory::build(LengthUnit::INCH)) ],
            [ '10 cm to ?in', new Query(new Value(10, UnitFactory::build(LengthUnit::CENTIMETRE)), UnitFactory::build(LengthUnit::INCH)) ],
            [ '10 cm to ? in', new Query(new Value(10, UnitFactory::build(LengthUnit::CENTIMETRE)), UnitFactory::build(LengthUnit::INCH)) ],
            [ '10 cm  to ?in', new Query(new Value(10, UnitFactory::build(LengthUnit::CENTIMETRE)), UnitFactory::build(LengthUnit::INCH)) ],
            [ '10 cm to   ?in', new Query(new Value(10, UnitFactory::build(LengthUnit::CENTIMETRE)), UnitFactory::build(LengthUnit::INCH)) ],
            [ '10cm to in', new Query(new Value(10, UnitFactory::build(LengthUnit::CENTIMETRE)), UnitFactory::build(LengthUnit::INCH)) ],
            [ '10cm  to  in', new Query(new Value(10, UnitFactory::build(LengthUnit::CENTIMETRE)), UnitFactory::build(LengthUnit::INCH)) ],
        ];
    }
}