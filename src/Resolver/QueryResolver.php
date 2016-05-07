<?php

namespace UnitConverter\Resolver;

use UnitConverter\Exception\QueryException;
use UnitConverter\Unit\UnitFactory;
use UnitConverter\Value\Value;

class QueryResolver
{
    /**
     * @param string $rawQuery
     * @return Query
     * @throws QueryException
     * @throws \UnitConverter\Exception\NotSupportedUnitException
     */
    public function resolve(string $rawQuery) : Query
    {
        if (!preg_match('/(?<value>\d+)\s?(?<valueUnit>[a-z]{2})\s{1,}to\s{1,}(?:\?)?\s?(?<targetUnit>[a-z]{2})/', $rawQuery, $matches)) {
            throw new QueryException(sprintf('Not supported query: %s', $rawQuery));
        }

        return new Query(
            new Value($matches['value'], UnitFactory::build($matches['valueUnit'])),
            UnitFactory::build($matches['valueUnit'])
        );
    }
}