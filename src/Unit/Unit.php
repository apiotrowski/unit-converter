<?php

namespace UnitConverter\Unit;

interface Unit
{
    const CM = 'cm';
    const IN = 'in';

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