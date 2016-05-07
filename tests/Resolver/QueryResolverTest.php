<?php

namespace UnitConverter\Resolver;

use UnitConverter\Unit\LengthUnit;
use UnitConverter\Unit\Unit;
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
     * @param Query $query
     */
    public function testResolveMethodReturnValueAndTarget(string $rawQuery, Query $query)
    {
        $query = $this->queryResolver->resolve($rawQuery);
        $this->assertInstanceOf(Query::class, $query);
        $this->assertInstanceOf(LengthUnit::class, $query->getTargetUnit());

        $this->assertEquals(10, $query->getValue()->getValue());
    }

    public function availableQuery()
    {
        return [
            [ '10cm to ?in', new Query(new Value(10, UnitFactory::build(LengthUnit::CM)), UnitFactory::build(LengthUnit::IN)) ],
            [ '10 cm to ?in', new Query(new Value(10, UnitFactory::build(LengthUnit::CM)), UnitFactory::build(LengthUnit::IN)) ],
            [ '10 cm to ? in', new Query(new Value(10, UnitFactory::build(LengthUnit::CM)), UnitFactory::build(LengthUnit::IN)) ],
            [ '10 cm  to ?in', new Query(new Value(10, UnitFactory::build(LengthUnit::CM)), UnitFactory::build(LengthUnit::IN)) ],
            [ '10 cm to   ?in', new Query(new Value(10, UnitFactory::build(LengthUnit::CM)), UnitFactory::build(LengthUnit::IN)) ],
            [ '10cm to in', new Query(new Value(10, UnitFactory::build(LengthUnit::CM)), UnitFactory::build(LengthUnit::IN)) ],
        ];
    }
}