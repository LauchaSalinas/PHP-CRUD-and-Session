<?php
    include("./manejoSesion.inc.php");
    $objArticulos = new stdClass();

    // Connect to DB
    $conn = mysqli_connect("us-cdbr-east-05.cleardb.net", "bd611d13de2cb8", "a2a57e98", "heroku_90adcdb504ee3cd");
    //print if not connected
    if (!$conn) $respuesta_estado = 'Error al contectar a la base de datos: ' . mysqli_connect_error();
    
    $sql = "SELECT * FROM cat";
    
    $result = $conn->query($sql);
    $opciones=[];
    if ($result->num_rows > 0) {
        // output data of each row
        while($row = $result->fetch_assoc()) {
            array_push($opciones,$row["catcol"]);
        }
    }
    $objArticulos->opciones = $opciones;
    mysqli_close($conn);
    echo json_encode($objArticulos,JSON_INVALID_UTF8_SUBSTITUTE); // envio objArticulos como JSON al front
?>