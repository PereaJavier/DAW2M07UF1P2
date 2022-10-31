<?php

use StuBanco\Entity\Cuenta;

require_once('../Entity/Cuenta.php');
session_start();
/**
 * Comprobamos si queremos añadir un usuario y redireccionamos
 */
function addCuenta()
{
    $cuentaBancaria = new Cuenta($_POST["inputSaldo"], $_POST["inputMoneda"], $_POST["inputNombre"]);
    if (!isset($_SESSION["ultimoIBAN"])) {
        $_SESSION["ultimoIBAN"] = 1;
    } else {
        $_SESSION["ultimoIBAN"]++;
    }
    $nuevoIBAN = $_SESSION["ultimoIBAN"];
    $cuentaBancaria->setIban($nuevoIBAN);
    $_SESSION["cuentas"][$cuentaBancaria->getIban()] = $cuentaBancaria;
    header("Location: ../Public/index.php");
}
function ingresarDinero()
{
    $dineroIngreso = $_POST["dinero"];
    $iban = $_POST["cuentaDest"];
    $saldoActual = $_SESSION["cuentas"][$iban]->getSaldo();
    $_SESSION["cuentas"][$iban]->setSaldo($saldoActual + $dineroIngreso);
}
function sacarDinero(): bool
{
    //Sacamos dinero en la cuenta
    $iban = $_POST["cuentaOrig"];
    
    $dineroExtract = $_POST["dinero"];
    $saldoActual = $_SESSION["cuentas"][$iban]->getSaldo();
    if($saldoActual - $dineroExtract >= 0){
        $_SESSION["cuentas"][$iban]->setSaldo($saldoActual - $dineroExtract);
        return true;
    }
    return false;
}

if (isset($_POST["anadirUsuario"]) && $_POST["inputSaldo"] != "" && $_POST["inputNombre"] != "") {
    addCuenta();
}
if (isset($_POST["ingresarDinero"])) {
    ingresarDinero();
}

if (isset($_POST["sacarDinero"])) {
    sacarDinero();
}
if (isset($_POST["transferirDinero"])) {
    if(sacarDinero()) //Si podemos sacar dinero (dejando a la cuenta como mínimo en 0€ haremos la transferencia)
        ingresarDinero();
    else
        echo "<br><font color='red'>Ha intentado transferir más dinero del que tiene en la cuenta.</font>";
}
?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <title>Gestión StuBanco</title>
</head>

<body>
    <div class="container-fluid">
        <div class="row col-12 justify-content-center">
            <h1 class="py-4 m-0 text-center">Menú principal Stucom</h1>
        </div>
        <div class="row col-12 justify-content-center">
            <form class="col-6 w-100" method="POST">
                <label class="col-12"><b>Consulte el saldo de una cuenta bancaria</b></label>
                <select name="saldoCuenta">
                    <?php
                    foreach ($_SESSION["cuentas"] as $iban => $cuenta) {
                        echo "<option value='Cuenta: " . $cuenta->getTitular() . "-" . $iban . " -> " . $cuenta->getSaldo() . $cuenta->getTipoMoneda() . "'>" . $cuenta->getTitular() . "-" . $iban . "</option>";
                    }
                    ?>
                </select>
                <?php
                if (isset($_POST["consultarCuenta"])) {
                    //Gestionamos las cuentas
                    echo ("<br>" . $_POST["saldoCuenta"] . "<br>");
                }
                ?>
                <input type="submit" value="Consultar cuenta" name="consultarCuenta">

            </form>

        </div>
        <div class="row col-12 justify-content-center">
            <form class="col-6 w-100" method="POST">
                <label class="col-12"><b>Ingrese dinero en una cuenta bancaria</b></label>
                <select name="cuentaDest">
                    <?php
                    foreach ($_SESSION["cuentas"] as $iban => $cuenta) {
                        echo "<option value='$iban'>" . $cuenta->getTitular() . "-" . $iban . "</option>";
                    }
                    ?>
                </select>
                <input type="number" min="0" name="dinero" placeholder="Dinero a ingresar" required>

                <div class="row px-5 py-2 justify-content-center">
                    <input type="submit" value="Ingresar dinero" name="ingresarDinero">
                </div>
            </form>
        </div>
        <div class="row col-12 justify-content-center">
            <form class="col-6 w-100" method="POST">
                <label class="col-12"><b>Saque dinero en una cuenta bancaria</b></label>
                <select name="cuentaOrig">
                    <?php
                    foreach ($_SESSION["cuentas"] as $iban => $cuenta) {
                        echo "<option value='$iban'>" . $cuenta->getTitular() . "-" . $iban . "</option>";
                    }
                    ?>
                </select>
                <input type="number" min="0" name="dinero" placeholder="Dinero a sacar" required>

                <div class="row px-5 py-2 justify-content-center">
                    <input type="submit" value="Sacar dinero" name="sacarDinero">
                </div>
            </form>
        </div>
        <div class="row col-20 justify-content-center">
            <form class="row px-5 py-2 justify-content-center" method="POST">
                <label class="col-10"><b>Transferencia de dinero en una cuenta bancaria</b></label>
                <select name="cuentaOrig">
                    <?php
                        foreach ($_SESSION["cuentas"] as $iban => $cuenta) {
                            echo "<option value='$iban'>" . "Cuenta Origen: ". $cuenta->getTitular() . "-" . $iban . "</option>";
                        }
                    ?>
                    <br>
                </select>
                
                <select name="cuentaDest">
                    <?php
                        foreach ($_SESSION["cuentas"] as $iban => $cuenta) {
                            echo "<option value='$iban'>" .  "Cuenta Destino: ".$cuenta->getTitular() . "-" . $iban . "</option>";
                        }
                    ?>
                    <br>
                </select><br><br>
                <input type="number" min="0" name="dinero" placeholder="Dinero a transferir" required>

                <div class="row px-5 py-2 justify-content-center">
                    <input type="submit" value="Transferir dinero" name="transferirDinero">
                </div>
            </form>
        </div>