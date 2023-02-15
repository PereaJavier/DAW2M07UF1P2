<?php

namespace Actividad_2\model;

use Actividad_2\model\Geometrico;
require_once "Geometrico.php";
class Circulo extends Geometrico
{
    private string $tipo;
    private float $radio;
    function __construct(float $radio){
        $this->radio = $radio;
	$tipo = "concentrico";
    }

    public function area(): float{
        $areaCirculo = pi()*pow($this->radio,2);
        $this->setArea($areaCirculo);
        return $this->getArea();
    }

}

