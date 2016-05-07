<?php

namespace UnitConverter\Unit;

interface Unit
{
    // length
    const CM = 'cm';
    const IN = 'in';
    const FT = 'ft';
    // time
    const HOUR = 'h';
    const MINUTE = 'min';
    const SECOND = 's';

    /**
     * @return array
     */
    function getConvertUnitMap();

    /**
     * @return string
     */
    function getName();

    /**
     * @return string
     */
    function __toString();
}