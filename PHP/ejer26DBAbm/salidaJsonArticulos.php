<?php
    //sleep(1);
    
    $articulos=[];

    $objArticulo = new stdclass;
    $objArticulo->cod = "SGSL57WH";
    $objArticulo->desc = "SLICK GUITARS SL57 WH STRATOCASTER";
    $objArticulo->cat = "GUITARRAS ELECTRICAS";
    $objArticulo->val = 58728.61;
    $objArticulo->stock = 5;
    $objArticulo->fechaAlta = "2022-01-01";
    array_push($articulos,$objArticulo);

    $objArticulo = new stdclass;
    $objArticulo->cod = "SGSL54BWN";
    $objArticulo->desc = "SLICK GUITARS SL54 BWN STRATOCASTER";
    $objArticulo->cat = "GUITARRAS ELECTRICAS";
    $objArticulo->val = 48356.73;
    $objArticulo->stock = 3;
    $objArticulo->fechaAlta = "2022-03-21";
    array_push($articulos,$objArticulo);

    $objArticulos = new stdClass(); // creo un objeto articulos
    $objArticulos->articulos=$articulos; // meto en objArticulos el array con objetos articulo
    $objArticulos->cuenta=count($articulos); // cuento cantidad de filas en array articulos
    
    echo json_encode($objArticulos); // envio objArticulos como JSON al front

?>