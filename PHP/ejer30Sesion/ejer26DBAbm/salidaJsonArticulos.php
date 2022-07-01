<?php
    include("./manejoSesion.inc.php");
    $objArticulos = new stdClass(); // creo un objeto articulos
    $objArticulos->success = FALSE;
    $respuesta_estado = 'ERROR';
    // Connect to DB
    $conn = mysqli_connect("us-cdbr-east-05.cleardb.net", "bd611d13de2cb8", "a2a57e98", "heroku_90adcdb504ee3cd");
    //print if not connected
    if (!$conn) 
    {$respuesta_estado = 'Error al conectar a la base de datos ' . mysqli_connect_error();}
    
    $sql = "SELECT cod, des, cat, val, sto, fec FROM art
    WHERE cod LIKE '%{$_GET['filtroCodigo']}%'
    and des LIKE '%{$_GET['filtroDescripcion']}%'
    and cat LIKE '%{$_GET['filtroCategoria']}%'
    and val LIKE '%{$_GET['filtroValor']}%'
    and sto LIKE '%{$_GET['filtroSaldo']}%'
    and fec LIKE '%{$_GET['filtroFechaAlta']}%'";
    $sql = str_replace(array("\n", "\r"), '', $sql);

    if (isset($_GET['orden']))
    {
        switch($_GET['orden'])
        {
            case "Codigo":
                $sql = $sql . " ORDER BY cod";
                break;
            case "Categoria":
                $sql = $sql . " ORDER BY cat";
                break;
            case "Valor":
                $sql = $sql . " ORDER BY val";
                break;
            case "Descripcion":
                $sql = $sql . " ORDER BY des";
                break;
            case "Fecha de Alta":
                $sql = $sql . " ORDER BY fec";
                break;
            case "Stock":
                $sql = $sql . " ORDER BY sto";
                break;
        }
    }

    $result = $conn->query($sql);
    $totalValor = 0;
    $totalStock = 0;
    $articulos=[];
    
    if ($result->num_rows > 0) {
        $objArticulos->success = TRUE;
        $respuesta_estado = "Consulta de datos exitosa!";
        // output data of each row
        while($row = $result->fetch_assoc()) {
            $objArticulo = new stdclass;
            $objArticulo->cod = $row["cod"];
            $objArticulo->desc = $row["des"];
            $objArticulo->cat = $row["cat"];
            $objArticulo->val = $row["val"];
            $objArticulo->stock = $row["sto"];
            $objArticulo->fechaAlta = $row["fec"];
            $totalValor = $totalValor+$objArticulo->val;
            $totalStock = $totalStock+$objArticulo->stock;
            array_push($articulos,$objArticulo);
        }
    }

    $objArticulos->articulos=$articulos; // meto en objArticulos el array con objetos articulo
    $objArticulos->cuenta=count($articulos); // cuento cantidad de filas en array articulos
    $objArticulos->totalValor = $totalValor;
    $objArticulos->totalStock = $totalStock;
    mysqli_close($conn);
    $objArticulos->respuesta_estado = $respuesta_estado;
    echo json_encode($objArticulos); // envio objArticulos como JSON al front
?>