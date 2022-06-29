<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Ejercicio 5 Variables Objeto</title>
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

        echo "<h2>Variables tipo objeto en PHP. Objeto renglon pedido</h2>";
        echo "<h2><span style='color: blue'>\$objRenglonPedido</span></h2>";

        $objRenglonPedido = new stdclass;
        $objRenglonPedido->codArt = "cp001";
        $objRenglonPedido->descrip = "Jaguel 800gr";
        $objRenglonPedido->precioUnitario = 2000;
        $objRenglonPedido->cant = "2";
        echo "codArt: " . $objRenglonPedido->codArt . "</br>";
        echo "descrip: " . $objRenglonPedido->descrip . "</br>";
        echo "precioUnitario: " . $objRenglonPedido->precioUnitario . "</br>";
        echo "cant: " . $objRenglonPedido->cant . "</br>";
        echo "<h2> Tipo de <span style='color: blue'>\$objRenglonPedido:</span> " . gettype($objRenglonPedido) . "</h2>" ;
        
        echo "<hr>";
        $renglonesPedido = [];
        array_push($renglonesPedido,$objRenglonPedido);
        $objRenglonPedido2 = new stdclass;
        $objRenglonPedido2->codArt = "cp002";
        $objRenglonPedido2->descrip = "Jagl 400gr";
        $objRenglonPedido2->precioUnitario = 1000;
        $objRenglonPedido2->cant = "5";
        array_push($renglonesPedido,$objRenglonPedido2);

        echo "<h2>Definamos arreglo de pedidos:</h2>";
        echo "<h2><span style='color: blue'>\$renglonesPedido</span></h2>";
        echo "<h2>Tabula <span style='color: blue'>\$renglonesPedido</span>. Recorrer el arreglo de renglones y tabularlos con HTML</h2>";
        foreach ($renglonesPedido as $objRenglonPedido)
        {
            echo "<p><pre>" . $objRenglonPedido->codArt . "&Tab;" . $objRenglonPedido->descrip . "&Tab;" . $objRenglonPedido->precioUnitario . "&Tab;" . $objRenglonPedido->cant . "</pre></p></br>";
        }
        echo "<hr>";
        

        $objRenglonesPedido = new stdClass();
        $objRenglonesPedido->renglonesPedido = $renglonesPedido;
        $objRenglonesPedido->cantidadDeRenglones = count($renglonesPedido);

        echo "<h2>Producción de un objeto <span style='color: blue'>\$objRenglonesPedido</span> con dos atributos array renglonesPedido y catidadDeRenglones</h2>";
        echo "<p>Cantidad de renglones: " . count($renglonesPedido) . "</p>";
        echo "<hr>";

        //JSON
        $jsonRenglonesPedido = json_encode($objRenglonesPedido);
        echo "<h2>Producción de un JSON jsonRenglones: </h2>";
        echo $jsonRenglonesPedido;
        

    ?>
    

</body>
</html>