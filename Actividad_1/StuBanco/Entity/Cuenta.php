<?php
namespace StuBanco\Entity;


class Cuenta {
    private float $saldo;
    private string $tipoMoneda;
    private string $iban;
    private string $titular;
    private const country="ES";

    public function __construct($saldo, $tipoMoneda, $titular)
    {
        $this->saldo = $saldo;
        $this->tipoMoneda = $tipoMoneda;
        $this->titular = $titular;
    }

    public function getTitular(){
        return $this->titular;
    }

    public function setTitular($titular){
        $this->titular = $titular;
        return $this;
    }

    public function getTipoMoneda(){
        return $this->tipoMoneda;
    }

    public function setTipoMoneda($tipoMoneda){
        $this->tipoMoneda = $tipoMoneda;
        return $this;
    }

    public function getSaldo(){
        return $this->saldo;
    }

    public function setSaldo($saldo){
        $this->saldo = $saldo;
        return $this;
    }
    public function getIban(){           
        return $this->iban;
    }
    public function setIban($id){
        $this->iban = self::country . $id;
    }


    public function __toString(){
        return "Hola, ". $this->titular . ", usted es el titular de la cuenta " . $this->iban . 
        ", usted dispone de " . $this->saldo . " " . $this->tipoMoneda . " en STUBanco";
    }
}



