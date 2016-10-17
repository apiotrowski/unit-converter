<?php

namespace UnitConverter\Unit;

interface Unit
{
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
