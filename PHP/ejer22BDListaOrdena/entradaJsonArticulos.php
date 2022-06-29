<?php
    // Connect to DB
    $conn = mysqli_connect("us-cdbr-east-05.cleardb.net", "bd611d13de2cb8", "a2a57e98", "heroku_90adcdb504ee3cd");
    //print if not connected
    if (!$conn) 
    {echo 'conection error ' . mysqli_connect_error();}

    $sql = "INSERT INTO `art`(`cod`, `des`, `cat`, `val`, `sto`, `fec`) VALUES ('" . $_GET['filtroCodigo'] . "','" . $_GET['filtroDescripcion'] . "','" . $_GET['filtroCategoria']. "'," . $_GET['filtroValor'] . "," . $_GET['filtroSaldo'] . ",'" . $_GET['filtroFechaAlta'] . "')";
    $result = $conn->query($sql);
    mysqli_close($conn);
    echo json_encode($result); // envio result

    
?>