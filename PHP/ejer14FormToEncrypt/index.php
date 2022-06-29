<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Ejercicio 6 Formulario</title>
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



</body>
</html>

<?php
    if (isset($_GET['variableAEncriptar']))
    {
        echo "<p>Clave: " . $_GET['variableAEncriptar']. "</p>";
        echo "<p>Clave encriptada en MD5 (128 bits o 16 pares hexadecimales):<p>";
        echo md5($_GET['variableAEncriptar']);
        echo "<p>Clave encriptada en SHA1 (160 bits o 20 pares hexadecimales):<p>";
        echo sha1($_GET['variableAEncriptar']);
    }
    else
    {
        echo <<< EOT
            <div id='form-container'>
            <form action='./index.php' method='GET'>
                
                <label for='variableAEncriptar'>variableAEncriptar: </label>
                <input type='text' name='variableAEncriptar' id='variableAEncriptar'><br><br>
                
                <button type='submit'>Enviar</button>
            </form>
            </div>
        EOT;
    }
    
?>