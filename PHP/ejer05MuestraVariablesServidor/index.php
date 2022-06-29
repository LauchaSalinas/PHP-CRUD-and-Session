<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Ejercicio 4 Muestra Variables Servidor</title>
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
    
    <?php
    echo "<h2>Variables del servidor</h2>";
    echo "SERVER_ADDR". ": " . $_SERVER["SERVER_ADDR"] . "</br>";
    echo "SERVER_PORT". ": " . $_SERVER["SERVER_PORT"] . "</br>";
    echo "SERVER_NAME". ": " . $_SERVER["SERVER_NAME"] . "</br>";
    echo "DOCUMENT_ROOT". ": " . $_SERVER["DOCUMENT_ROOT"] . "</br>";

    echo "<h2>Variables del cliente</h2>";
    echo "REMOTE_ADDR". ": " . $_SERVER["REMOTE_ADDR"] . "</br>";
    echo "REMOTE_PORT" . ": ". $_SERVER["REMOTE_PORT"]  . "</br>";

    echo "<h2>Variables del requerimiento</h2>";
    echo "SCRIPT_NAME". ": " . $_SERVER["SCRIPT_NAME"] . "</br>";
    echo "REQUEST_METHOD". ": " . $_SERVER["REQUEST_METHOD"] . "</br>";

    echo "<h2>TODAS</h2>";
    foreach($_SERVER as $key_name => $key_value)
    {
        echo $key_name . " " . $key_value . "</br>";
    }
    ?>
    

</body>
</html>