<?php 
    session_start();
    if(isset($_SESSION['username']))
    {
        header("Location: index.php");
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bienvenido a la aplicación!</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="addsearch-category" content="Ejercitación Laboratorio 3 - UTN Haedo" />
    <link rel="shortcut icon" href="../../Recursos/Imagenes/logo_favicon.ico">
    <meta name="author" content="Lautaro Salinas">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
</head>
<body>
    <div class="background-imageB" id="background-image"></div>
    <div class="content">
        <dix id="divExterno">
            <div id="divInputs">
                <form id="form" action="none">
                    <label for="username">Usuario:</label></br>
                    <input id="username" name="username" type="text" autocomplete="username" required></br></br>
                    <label for="password">Contraseña:</label></br>
                    <input id="password" name="password" type="password" required autocomplete="current-password"></br></br>
                </form>
                <div id="infoLogin">
                </div>
                <div id="divBotonesIngreso">
                    <a href="./ejer26DBAbm/index.php"><button id="btnIngresoApp" hidden>Ingresar a la aplicación</button></a>
                    <a href="./destruirSesion.php"><button id="btnCierraSesion" hidden>Cerrar sesión</button></a>
                </div>
            </div>
            
            <div id="divControl">
                <button type="button" id="btnSubmit">Login</button>
                <a href="./signup.html"> <button type="button" id="btnCrearUser">Nueva cuenta</button></a>
            </div>
            <div id="divPresentacion">
            </div>
        </dix>
    </div>
    <script type="module" src="./main.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
</body>
</html>
