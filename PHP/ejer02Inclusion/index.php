<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Ejercicio 2 Inclusión</title>
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
    <h4>En este ejemplo se utiliza la función include() que ubica código php definido en el archivo ejemplo2.inc:</h4>
    <h4>Antes de insertar el include las variables declaradas en el mismo no existen.
    </br>Las variables son:</h4>
    
    <?php
    echo $variableInclude[0]["legEmpleado"];
    echo $variableInclude[0]["Apellido"];
    echo $variableInclude[0]["salarioBasico"];
    echo $variableInclude[0]["fechaIngr"];
    //echo "<p>La longuitud de los arreglos es: " . count($variableInclude) . "</p>";
    include("./ejemplo2.inc.php");
    echo "<h4>Aquí ya se ejecutó la función include(). Cuando se usa include ocurre que si el archivo '.inc' no existe, se visualiza un warning y el script sigue ejecutándose hasta el final.</h4>";
    echo "<h4>Las " . count($variableInclude) . " variables de tipo array asociativo en el .inc son:</h4>";

    echo "<div style='width: 40%'><table style='border: solid 2px; border-collapse: collapse; background-color: cornflowerblue;'><tbody>";
    
    for($i = 0; $i < 2; $i++)
    {
        echo "<tr>";
        echo "<td style='border: solid 1px; padding-left: 10px;'>" . $variableInclude[$i]["legEmpleado"] . "</td>";
        echo "<td style='border: solid 1px; padding-left: 10px;'>" . $variableInclude[$i]["Apellido"] . "</td>";
        echo "<td style='border: solid 1px; padding-left: 10px;'>" . $variableInclude[$i]["salarioBasico"] . "</td>";
        echo "<td style='border: solid 1px; padding-left: 10px;'>" . $variableInclude[$i]["fechaIngr"] . "</td>";

    }
    
    echo "</tbody></table></div>";


    echo "<p>La longuitud de cada uno de los " . count($variableInclude) . " arreglos es: " . count($variableInclude[0]) . "</p>";

    ?>
    

</body>
</html>