<?php
    $success_sv = TRUE;
    $respuesta_estado_sv="";
    //set repot mode for sqli
    mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);
    // Connect to DB
    $conn = mysqli_connect("us-cdbr-east-05.cleardb.net", "bd611d13de2cb8", "a2a57e98", "heroku_90adcdb504ee3cd");
    //print if not connected
    try{
        if (!$conn) $respuesta_estado = 'Error al contectar a la base de datos: ' . mysqli_connect_error();
    }
    catch (mysqli_sql_exception $e) {
        $success_sv = FALSE;
        $respuesta_estado_sv = $e->getMessage() ;
    }

?>