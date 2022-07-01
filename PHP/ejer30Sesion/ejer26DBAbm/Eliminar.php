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

        $sql = "DELETE FROM `art` WHERE `cod`='" . $_GET['codArticulo'] . "'";
        $result = $conn->query($sql);
        
        if ($result === TRUE) 
        {
            $respuesta_estado = "Artículo eliminado exitosamente!";
            $objArticulos->success = TRUE;
        } 
        else 
        {
            $respuesta_estado = "Error al eliminar el artículo: " . $objArticulos->codArticulo = $_GET['codArticulo'];
        }
    }
    mysqli_close($conn);
    $objArticulos->respuesta_estado = $respuesta_estado;
    echo json_encode($objArticulos,JSON_INVALID_UTF8_SUBSTITUTE); // envio objArticulos como JSON al front
?>