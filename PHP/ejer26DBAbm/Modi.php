<?php
    $objArticulos = new stdClass();
    $objArticulos->success = FALSE;
    // Connect to DB
    $conn = mysqli_connect("us-cdbr-east-05.cleardb.net", "bd611d13de2cb8", "a2a57e98", "heroku_90adcdb504ee3cd");
    //print if not connected
    if (!$conn) $respuesta_estado = 'Error al contectar a la base de datos: ' . mysqli_connect_error();
    $objArticulos->codArticulo = $_POST['codArticulo'];

    if(!isset($_FILES['formPDF'])) 
    {
        $sql = "INSERT INTO `art`(`cod`, `des`, `cat`, `val`, `sto`, `fec`) VALUES ('" . $_POST['codArticulo'] . "','" . $_POST['desc'] . "','" . $_POST['cat']. "'," . $_POST['valor'] . "," . $_POST['stock'] . ",'" . $_POST['fechaAlta'] . "')";
        $result = $conn->query($sql);
    
        if ($result === TRUE) 
        {
            $respuesta_estado = "Artículo modificado exitosamente!</br>Sin modificar el archivo PDF";
            $objArticulos->success = TRUE;
        } 
        else 
        {
            $respuesta_estado = "Error al modificar el artículo: " . $objArticulos->codArticulo = $_POST['codArticulo'];
        }
    }
    else 
    {
        if (empty($_FILES['formPDF']['name'])) 
        {
            $sql = "UPDATE `art` SET `cod`= '" . $_POST['codArticulo'] . "' , `des`= '" . $_POST['desc'] . "' , `cat`= '" . $_POST['cat'] . "' , `val`= '" . $_POST['valor'] . "' , `sto`= '" . $_POST['stock'] . "' , `fec`= '" . $_POST['fechaAlta'] . "' WHERE `cod`='" . $_POST['codArticuloOriginal'] . "'";
            $result = $conn->query($sql);
        
            if ($result === TRUE) 
            {
                $respuesta_estado = "Artículo modificado exitosamente!</br>Sin modificar el archivo PDF";
                $objArticulos->success = TRUE;
            } 
            else 
            {
                $respuesta_estado = "Error al modificar el artículo: " . $objArticulos->codArticulo = $_POST['codArticulo'];
            }
        }
        else
        {
            $documentoPdf = base64_encode(file_get_contents($_FILES['formPDF']['tmp_name']));
            $sql = "UPDATE `art` SET `cod`= '" . $_POST['codArticulo'] . "' , `des`= '" . $_POST['desc'] . "' , `cat`= '" . $_POST['cat'] . "' , `val`= '" . $_POST['valor'] . "' , `sto`= '" . $_POST['stock'] . "' , `fec`= '" . $_POST['fechaAlta'] . "' , `pdf`= '" . $documentoPdf . "' WHERE `cod`='" . $_POST['codArticulo'] . "'";
            $result = $conn->query($sql);
        
            if ($result === TRUE) 
            {
                $respuesta_estado = "Artículo modificado exitosamente!</br>Con archivo PDF!";
                $objArticulos->success = TRUE;
            } 
            else 
            {
                $respuesta_estado = "Error al modificar el artículo: " . $objArticulos->codArticulo = $_POST['codArticulo'];
            }
            mysqli_close($conn);

        }

    }
    $objArticulos->respuesta_estado = $respuesta_estado;
    echo json_encode($objArticulos,JSON_INVALID_UTF8_SUBSTITUTE); // envio objArticulos como JSON al front
?>