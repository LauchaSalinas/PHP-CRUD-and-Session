<?php
        sleep(3);
            $objUsuario = new stdclass;

            $objUsuario->ID_Usuario = $_POST['ID_Usuario'];
            $objUsuario->Login = $_POST['Login'];
            $objUsuario->Nombre = $_POST['Nombre'];
            $objUsuario->Apellido = $_POST['Apellido'];
            $objUsuario->Fecha_Nac = $_POST['Fecha_Nac'];
            
            echo json_encode($objUsuario);

?>