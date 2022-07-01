<?php

    $objJSON = new stdClass();
    $objJSON->success = FALSE;

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


    session_start();
    session_unset();
    session_destroy();
    
        if(empty($_POST['username'])) $respuesta_estado = "No se ha enviado un usuario válido";
        else
        {
            $username = $_POST['username'];
            $password = hash("sha512",$_POST['password'],false);
            $sql = "INSERT INTO `usps`(`u`, `p`) VALUES ('" . $username . "','" . $password . "')";
            session_start();
            $_SESSION['username'] = $_POST['username'];
            $respuesta_estado = "Usuario creado con éxito!";
            $objJSON->session = $_POST['username'];
            $objJSON->session_id = session_id();
            $objJSON->success = TRUE;
            try 
            {
                $result = $conn->query($sql);
            }
            catch (mysqli_sql_exception $e) {
                $respuesta_estado = $e->getMessage() ;
                if (strstr( $respuesta_estado, 'Duplicate entry' )) $respuesta_estado = "Entrada duplicada</br>Por favor ingrese otro usuario";
                $objJSON->success = FALSE;
            }
        }

        mysqli_close($conn);
        $objJSON->respuesta_estado_sv = $respuesta_estado_sv;
        $objJSON->success_sv = $success_sv;
        $objJSON->respuesta_estado = $respuesta_estado;
        echo json_encode($objJSON,JSON_INVALID_UTF8_SUBSTITUTE); // envio objArticulos como JSON al front
?>