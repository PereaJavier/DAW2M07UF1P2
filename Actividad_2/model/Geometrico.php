<?php
namespace Actividad_2\model;

abstract class Geometrico{
    private float $area;
    abstract function area();



    /**
     * Set the value of area
     *
     * @return  self
     */ 
    public function setArea($area)
    {
        $this->area = $area;

        return $this;
    }

    /**
     * Get the value of area
     */ 
    public function getArea()
    {
        return $this->area;
    }
}
