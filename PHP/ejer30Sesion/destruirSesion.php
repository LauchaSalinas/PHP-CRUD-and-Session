<?php 
    $objJSON = new stdClass();
    
    session_start();
    session_unset();
    session_destroy();

    if(!isset($_SESSION['username']))
    {
        $objJSON->success = TRUE;
        //echo json_encode($objJSON,JSON_INVALID_UTF8_SUBSTITUTE);
        header("Location: index.php");
    }
    else
    {
        $objJSON->success = FALSE;
        //echo json_encode($objJSON,JSON_INVALID_UTF8_SUBSTITUTE);
    }
?>