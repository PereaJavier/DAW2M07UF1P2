<?php    
    session_start();
    if(isset($_POST["eliminarCuentas"])){
        session_destroy();
    }
?>

<!DOCTYPE html>
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
            <h1 class="py-4 m-0 text-center">Creación de cuentas bancariasSTUBanco</h1>
        </div>
        <div class="row col-12 justify-content-center">
            <form class="col-6 w-100" method="POST" action="../Controller/MenuCuentaBanc.php">
                <div class="row px-5">
                    <label class="col-12">Cree una cuenta bancaria</label>
                    <input class="col-sm-12 col-lg-5" type="text" name="inputNombre" placeholder="Introduzca su nombre" required>
                    <input class="col-sm-10 col-lg-5" type="number" min="0" name="inputSaldo" placeholder="Introduzca su saldo" required>
                    <select class="p-0 col-sm-2 col-lg-2" name="inputMoneda">
                        <option value="$">$</option>
                        <option value="€">€</option>
                    </select>
                </div>
                <div class="row py-2 justify-content-center">
                    <input type="submit" value="Añadir cuenta" name="anadirUsuario">
                </div>
               
            </form>
           
        </div>
        <div class="row col-12 justify-content-center">
            <form class="col-6 w-100" method="POST" action="../Controller/MenuCuentaBanc.php">
                <div class="row px-5 py-2 justify-content-center">
                    <input type="submit" value="Gestionar cuentas" name="gestionarCuentas">
                </div>
            </form>
        </div>
        <div class="row col-12 justify-content-center">
            <form class="col-6 w-100" method="POST">
                <div class="row px-5 py-2 justify-content-center">
                    <input type="submit" value="Eliminar cuentas" name="eliminarCuentas">
                </div>
            </form>
        </div>
        
    </div>
</body>

</html>

