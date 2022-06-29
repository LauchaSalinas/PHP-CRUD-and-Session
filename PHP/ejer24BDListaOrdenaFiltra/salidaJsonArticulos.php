<?php
    // Connect to DB
    $conn = mysqli_connect("us-cdbr-east-05.cleardb.net", "bd611d13de2cb8", "a2a57e98", "heroku_90adcdb504ee3cd");
    //print if not connected
    if (!$conn) 
    {echo 'conection error ' . mysqli_connect_error();}
    
    //$sql = "INSERT INTO `art`(`cod`, `des`, `cat`, `val`, `sto`, `fec`) VALUES ('SGSL54BWN','SLICK GUITARS SL54 BWN STRATOCASTER','GUITARRAS ELECTRICAS','48356.73','3','2022-03-21')";
    //$result = $conn->query($sql);
    $sql = "SELECT * FROM `art`";
    
    if(($_GET['filtroCodigo'])!="" or ($_GET['filtroCategoria'])!="" or ($_GET['filtroValor'])!="" or ($_GET['filtroDescripcion'])!="" or ($_GET['filtroFechaAlta'])!="" or ($_GET['filtroSaldo'])!="")
    {
        $sql = $sql . " WHERE ";
        if (($_GET['filtroCodigo'])!="") $sql = $sql . "cod LIKE '%" . $_GET['filtroCodigo'] . "%'";
        if(($_GET['filtroCategoria'])!="" or ($_GET['filtroValor'])!="" or ($_GET['filtroDescripcion'])!="" or ($_GET['filtroFechaAlta'])!="" or ($_GET['filtroSaldo'])!="")
        {
            if (substr($sql, -6) != "WHERE " and substr($sql, -5) != " and ") $sql = $sql . " and ";
            if (($_GET['filtroCategoria'])!="") $sql = $sql . "cat LIKE '%" . $_GET['filtroCategoria'] . "%'";
            if(($_GET['filtroValor'])!="" or ($_GET['filtroDescripcion'])!="" or ($_GET['filtroFechaAlta'])!="" or ($_GET['filtroSaldo'])!="")
            {
                if (substr($sql, -6) != "WHERE " and substr($sql, -5) != " and ") $sql = $sql . " and ";
                if (($_GET['filtroValor'])!="") $sql = $sql . "val=" . $_GET['filtroValor'];;
                if (($_GET['filtroDescripcion'])!="" or ($_GET['filtroFechaAlta'])!="" or ($_GET['filtroSaldo'])!="")
                {
                    if (substr($sql, -6) != "WHERE " and substr($sql, -5) != " and ") $sql = $sql . " and ";
                    if (($_GET['filtroDescripcion'])!="") $sql = $sql . "des LIKE '%" . $_GET['filtroDescripcion'] . "%'";
                    if (($_GET['filtroFechaAlta'])!="" or ($_GET['filtroSaldo'])!="")
                    {
                        if (substr($sql, -6) != "WHERE " and substr($sql, -5) != " and ") $sql = $sql . " and ";
                        if (($_GET['filtroFechaAlta'])!="") $sql = $sql . "fec LIKE '%" . $_GET['filtroFechaAlta'] . "%'";
                        if (($_GET['filtroSaldo'])!="")
                        {
                            if (substr($sql, -6) != "WHERE " and substr($sql, -5) != " and ") $sql = $sql . " and ";
                            if (($_GET['filtroSaldo'])!="") $sql = $sql . "sto=" . $_GET['filtroSaldo'];
                        }
                    }
                }
            }
        }
    }

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

    if ($result->num_rows > 0) {
        $articulos=[];
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
    $objArticulos = new stdClass(); // creo un objeto articulos
    $objArticulos->articulos=$articulos; // meto en objArticulos el array con objetos articulo
    $objArticulos->cuenta=count($articulos); // cuento cantidad de filas en array articulos
    $objArticulos->totalValor = $totalValor;
    $objArticulos->totalStock = $totalStock;
    mysqli_close($conn);
    echo json_encode($objArticulos); // envio objArticulos como JSON al front

    
?>