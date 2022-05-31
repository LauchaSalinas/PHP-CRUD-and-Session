<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Ejercicio 1 Base</title>
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
    <p>Todo lo escrito fuera de las marcas de php es entregado en la respuesta http sin pasar por el procesador php.</p>
    <hr>
    
    <?php
    echo '<p>Todo texto y/o html <span style="color: blue">entregado por el procesador php</span> usando la sentencia echo.</p4>';
    echo "<hr>";

    //concat
    $miVariable="valor1";
    echo "<p>Sin usar concatenador <span style='color: blue'>\$miVariable</span>: $miVariable</p>";
    echo "<p>Usando concatenador <span style='color: blue'>\$miVariable</span>: " . $miVariable . "</p>";
    echo "<hr>";
    
    //bool
    $miVariable=true;
    echo "<p>Variable tipo booleana o lógica (verdadero) <span style='color: blue'>\$miVariable</span>: " . $miVariable . "</p>";
    $miVariable=false;
    echo "<p>Variable tipo booleana o lógica (falsa) <span style='color: blue'>\$miVariable</span>: " . $miVariable . "</p>";
    echo "<hr>";

    //constantes
    define("MICONSTANTE", "valorConstate");
    echo "<p><span style='color: blue'>MICONSTANTE</span>: " . MICONSTANTE . "</p>";
    echo "<p>Tipo de <span style='color: blue'>MICONSTANTE</span>: " . gettype(MICONSTANTE) . "</p>";
    echo "<hr>";

    //Arreglos
    echo "<h4>Arreglos</h4>";
    $aMiArreglo = ["Hola","Hello"];
    echo "<p><span style='color: blue'>\$aMiArreglo</span>: " . $aMiArreglo[0] . "</p>";
    echo "<p><span style='color: blue'>\$aMiArreglo</span>: " . $aMiArreglo[1] . "</p>";
    array_push($aMiArreglo,"Ciao");
    array_push($aMiArreglo,"Salut");
    array_push($aMiArreglo,"Hallo");
    echo "Tipo de <span style='color: blue'>\$aMiArreglo</span>: " . gettype($aMiArreglo) . "</p>";
    echo "<p>Se agregan por programa tres elementos nuevos<p>";
    echo "<h4>Todos los elementos originales y agregados</h4>";
    echo "<ul>";
    foreach($aMiArreglo as $varMiArreglo)
    {
        echo "<li>" . $varMiArreglo . "</li>";
    }
    echo "</ul>";

    //arreglos bidimensionales
    $aIdiomas = ["Español", "Ingles", "Italiano", "Francés", "Alemán"];
    $aIdiomas2 =[];
    $aEspañol = ["Hola","Por favor", "Gracias", "De nada", "Adiós"];
    $aIngles = ["Hello","Please", "Thanks", "You're welcome", "Goodbye"];
    $aItaliano = ["Ciao","Per favore", "Grazie", "Prego", "Addio"];
    $aFrancés = ["Salut","S'il vous plaît", "Merci", "De rien", "Adieu"];
    $aAlemán = ["Hallo","Bitte", "Danke", "Gerne geschehen", "Tchuss"];

    array_push ($aIdiomas2,$aEspañol);
    array_push ($aIdiomas2,$aIngles);
    array_push ($aIdiomas2,$aItaliano);
    array_push ($aIdiomas2,$aFrancés);
    array_push ($aIdiomas2,$aAlemán);

    echo "<h4>Arreglo de dos dimensiones (diccionario)</h4>";
    echo "<div style='width: 40%'><table style='border: solid 2px; border-collapse: collapse; background-color: cornflowerblue;'><thead><tr>";

    for($i = 0; $i < 5; $i++ )
    {
        echo "<th scope='colgroup' style='width: 200px; height: 35px; border: solid 1px;'>" . $aIdiomas[$i] . "</th>";
    }
    echo "</tr></thead><tbody>";
    
    for($j = 0; $j < 5; $j++ )
    {
        echo "<tr>";
        for ($i = 0; $i < 5; $i++)
        {
            echo "<td style='border: solid 1px; padding-left: 10px;'>" . $aIdiomas2[$i][$j] . "</th>";
        }
        
    }
    
    echo "</tbody></table></div>";
    echo "<p>También así se puede expresar el valor de <span style='color: blue'>\$aIdiomas2[2][3]: " . $aIdiomas2[2][3] . "</p>";
    echo "<p>Cantidad de elementos de diccionario: " . count($aIdiomas) . "</p>";

    //variables del tipo asociativo
    echo "<h2>Variables de tipo arreglo asociativo</h2>";
    $renglonDeLiquidacion = ["legEmpleado"=>"c0001","Apellido"=>"Witt","salarioBasico"=>20000,"fechaIngr"=>"02/04/2019"];
    echo "<p>";
    echo "Legajo de empleado: " . $renglonDeLiquidacion['legEmpleado'] . "</br>" ;
    echo "Apellido: " . $renglonDeLiquidacion['Apellido'] . "</br>" ;
    echo "Salario básico: " . $renglonDeLiquidacion['salarioBasico'] . "</br>" ;
    echo "Fecha de ingreso: " . $renglonDeLiquidacion['fechaIngr'];
    echo "</p>";

    echo "<p>";
    echo "Cantidad de elementos: " . count($renglonDeLiquidacion) . "</br>";
    echo "Tipo de dato: " . gettype($renglonDeLiquidacion);
    echo "</p>";
    echo "<hr>";

    //expresiones aritméticas
    echo "<h4>Expresiones aritméticas</h4>";
    $x = 10;
    $y = 5;

    echo "<p>La variable <span style='color: blue'>\$x</span> tiene el siguiente valor: " . $x . "</p>";
    echo "<p>La variable <span style='color: blue'>\$y</span> tiene el siguiente valor: " . $y . "</p>";
    echo "<p>La variable <span style='color: blue'>\$x</span> tiene el siguiente tipo: " . gettype($x) . "</p>";
    echo "<p>La variable <span style='color: blue'>\$y</span> tiene el siguiente tipo: " . gettype($y) . "</p>";

    echo "<p>Así se imprime una expresión aritmética, por ejemplo de <span style='font-weight: bold'>suma</span>: <span style='color: blue'>(\$x + \$y)</span> = " . $x + $y;
    echo "<p>Así se imprime una expresión aritmética, por ejemplo de <span style='font-weight: bold'>multiplicación</span>: <span style='color: blue'>(\$x * \$y)</span> = " . $x * $y;
    echo "<p>Así se imprime una expresión aritmética, por ejemplo de <span style='font-weight: bold'>división</span>: <span style='color: blue'>(\$x / \$y)</span> = " . $x / $y;
    ?>
    

</body>
</html>