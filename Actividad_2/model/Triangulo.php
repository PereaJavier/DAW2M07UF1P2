<?php
namespace Actividad_2\model;

use Actividad_2\model\Geometrico;

require_once 'Geometrico.php';

class Triangulo extends Geometrico{
    private $base;
    private $altura;

    public function __construct(float $base, float $altura)
    {
        $this->base = $base;
        $this->altura = $altura;
    }

    public function area(){
        $area = ($this->base * $this->altura) / 2;
        $this->setArea($area);
        return $this->getArea();
    }
}