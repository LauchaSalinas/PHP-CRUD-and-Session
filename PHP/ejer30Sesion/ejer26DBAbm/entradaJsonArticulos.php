<?php
    include("./manejoSesion.inc.php");
    $objArticulos = new stdClass();
    $objArticulos->success = FALSE;


    //set repot mode for sqli
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // Connect to DB
    $conn = mysqli_connect("us-cdbr-east-05.cleardb.net", "bd611d13de2cb8", "a2a57e98", "heroku_90adcdb504ee3cd");
    //print if not connected
    if (!$conn) $respuesta_estado = 'Error al contectar a la base de datos: ' . mysqli_connect_error();
    
    $objArticulos->codArticulo = $_POST['codArticulo'];
    try {
    if(!isset($_FILES['formPDF'])) 
    {
        $sql = "INSERT INTO `art`(`cod`, `des`, `cat`, `val`, `sto`, `fec`) VALUES ('" . $_POST['codArticulo'] . "','" . $_POST['desc'] . "','" . $_POST['cat']. "'," . $_POST['valor'] . "," . $_POST['stock'] . ",'" . $_POST['fechaAlta'] . "')";
        $result = $conn->query($sql);
    
        if ($result === TRUE) 
        {
            $respuesta_estado = "Artículo añadido exitosamente!</br>Falta el archivo PDF";
            $objArticulos->success = TRUE;
        } 
        else 
        {
            $respuesta_estado = "Error al agregar el artículo: " . $objArticulos->codArticulo = $_POST['codArticulo'];
        }
    }
    else 
    {
        if (empty($_FILES['formPDF']['name'])) 
        {
            $sql = "INSERT INTO `art`(`cod`, `des`, `cat`, `val`, `sto`, `fec`) VALUES ('" . $_POST['codArticulo'] . "','" . $_POST['desc'] . "','" . $_POST['cat']. "'," . $_POST['valor'] . "," . $_POST['stock'] . ",'" . $_POST['fechaAlta'] . "')";
            $result = $conn->query($sql);
        
            if ($result === TRUE) 
            {
                $respuesta_estado = "Artículo añadido exitosamente!</br>Falta el archivo PDF";
                $objArticulos->success = TRUE;
            } 
            else 
            {
                $respuesta_estado = "Error al agregar el artículo: " . $objArticulos->codArticulo = $_POST['codArticulo'];
            }
        }
        else
        {
            $documentoPdf = base64_encode(file_get_contents($_FILES['formPDF']['tmp_name']));
            $sql = "INSERT INTO `art`(`cod`, `des`, `cat`, `val`, `sto`, `fec`, `pdf`) VALUES ('" . $_POST['codArticulo'] . "','" . $_POST['desc'] . "','" . $_POST['cat']. "'," . $_POST['valor'] . "," . $_POST['stock'] . ",'" . $_POST['fechaAlta'] . "','" . $documentoPdf . "')";
            $result = $conn->query($sql);
        
            if ($result === TRUE) 
            {
                $respuesta_estado = "Artículo añadido exitosamente!</br>Con archivo PDF!";
                $objArticulos->success = TRUE;
            } 
            else 
            {
                $respuesta_estado = "Error al agregar el artículo: " . $objArticulos->codArticulo = $_POST['codArticulo'];
            }
            mysqli_close($conn);

        }

    }
    } catch (mysqli_sql_exception $e) {
        $respuesta_estado = $e->getMessage() ;
        if (strstr( $respuesta_estado, 'Duplicate entry' )) $respuesta_estado = "Entrada duplicada</br>Por favor ingrese otro código";
    }
    $objArticulos->respuesta_estado = $respuesta_estado;
    echo json_encode($objArticulos,JSON_INVALID_UTF8_SUBSTITUTE); // envio objArticulos como JSON al front
?>