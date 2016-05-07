<?php

namespace UnitConverter\Unit;

abstract class AbstractUnit implements Unit
{
    /** @var string */
    protected $name;

    abstract function getConvertUnitMap();

    /**
     * @return string
     */
    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function __toString() : string
    {
        return $this->name;
    }
}