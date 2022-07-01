<?php

    $objJSON = new stdClass();
    $objJSON->success = FALSE;
    include('datosConexionBase.inc.php');
    session_start();
    
    if(isset($_SESSION['username'])) header("Location: index.php");
    else
    {
        if(!isset($_POST['username'])) $respuesta_estado = "No se ha enviado un usuario válido";
        else
        {
            //cargar variables del formulario en los campos de la sesion
            $username = $_POST['username'];
            $password = hash("sha512",$_POST['password'],false);
            
            //consulta al servidor de los valores
            $sql = "SELECT * FROM `usps` WHERE `u`='" . $username . "'";
            $result = $conn->query($sql); // implementar try catch
            $row = $result->fetch_assoc();

            //chequear usuario
            if ($result->num_rows > 0 and $username == $row["u"]) 
            {
                //chequear password
                if($password != $row["p"]) $respuesta_estado = "Constraseña incorrecta!";
                else{
                    $_SESSION['username'] = $_POST['username'];
                    $objJSON->session_id = session_id();
                    $objJSON->success = TRUE;
                    $objJSON->session = $_SESSION['username'];

                    $respuesta_estado = "Usuario logueado correctamente!";
                    //session_destroy();
                }
            }
            else $respuesta_estado = "El usuario no existe!";
        }
        mysqli_close($conn);
        $objJSON->respuesta_estado = $respuesta_estado;
        echo json_encode($objJSON,JSON_INVALID_UTF8_SUBSTITUTE); // envio objArticulos como JSON al front
    }
?>