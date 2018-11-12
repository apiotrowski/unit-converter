<?php

namespace UnitConverter\Tests\Resolver;

use PHPUnit\Framework\TestCase;
use UnitConverter\Exception\NotSupportedUnitException;
use UnitConverter\Exception\QueryException;
use UnitConverter\Resolver\Query;
use UnitConverter\Resolver\QueryResolver;
use UnitConverter\Unit\LengthUnit;
use UnitConverter\Unit\UnitFactory;
use UnitConverter\Value\Value;

class QueryResolverTest extends TestCase
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
     *
     * @throws NotSupportedUnitException
     * @throws QueryException
     */
    public function testResolveMethodReturnValueAndTarget(string $rawQuery, Query $expectedQuery)
    {
        $query = $this->queryResolver->resolve($rawQuery);
        $this->assertInstanceOf(Query::class, $query);
        $this->assertInstanceOf(LengthUnit::class, $query->getTargetUnit());
        $this->assertEquals(10, $query->getValue()->getValue());
        $this->assertEquals($expectedQuery, $query);
    }

    /**
     * @return array
     *
     * @throws NotSupportedUnitException
     */
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
