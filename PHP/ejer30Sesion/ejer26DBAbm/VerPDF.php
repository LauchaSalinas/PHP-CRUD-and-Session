<?php
    include("./manejoSesion.inc.php");
    $objArticulos = new stdClass();
    $objArticulos->success = FALSE;
    // Connect to DB
    $conn = mysqli_connect("us-cdbr-east-05.cleardb.net", "bd611d13de2cb8", "a2a57e98", "heroku_90adcdb504ee3cd");
    //print if not connected
    if (!$conn) $respuesta_estado = 'Error al contectar a la base de datos: ' . mysqli_connect_error();

    
    
    if(!isset($_GET['codArticulo'])) $respuesta_estado = "No se ha enviado un codigo de artículo válido";
    else 
    {
        $objArticulos->codArticulo = $_GET['codArticulo'];

        $sql = "SELECT `pdf` FROM `art` WHERE `cod`='" . $_GET['codArticulo'] . "'";
        
        $result = $conn->query($sql);
    
        if ($result->num_rows > 0) {
            // output data of each row
            while($row = $result->fetch_assoc()) {
                $objArticulos->documentoPDF = $row["pdf"];
            }
            if (!empty($objArticulos->documentoPDF))
            {
                $objArticulos->success = TRUE;
                $respuesta_estado = "Consulta exitosa!";
            } 
            else $respuesta_estado = "El código enviado no posee archivo PDF";
        }
        else $respuesta_estado = "No se encuentra un artículo con el codigo de artículo: " . $objArticulos->codArticulo;
    }
    mysqli_close($conn);
    $objArticulos->respuesta_estado = $respuesta_estado;
    echo json_encode($objArticulos,JSON_INVALID_UTF8_SUBSTITUTE); // envio objArticulos como JSON al front
?>