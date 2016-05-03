<?php

namespace UnitConverter\Unit;

interface Unit
{
    /**
     * @return string
     */
    public function getName();

    /**
     * @return string
     */
    public function __toString();
}