<?php

namespace Actividad_2\model;

use Actividad_2\model\Geometrico;
require_once "Geometrico.php";
class Circulo extends Geometrico
{
    private float $radio;
    function __construct(float $radio){
        $this->radio = $radio;
    }

    public function area(): float{
        $areaCirculo = pi()*pow($this->radio,2);
        $this->setArea($areaCirculo);
        return $this->getArea();
    }

}

