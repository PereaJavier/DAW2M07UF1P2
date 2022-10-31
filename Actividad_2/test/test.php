<?php
    use Actividad_2\model;
    require_once("../model/Circulo.php");
    require_once("../model/Triangulo.php");

    $circulo = new model\Circulo(10.23);
    $triangulo = new model\Triangulo(5,3);

    echo "Área del círculo: " . $circulo->area()."\n";
    echo "Área del triángulo: " . $triangulo->area();

?>