<?php
    include("./manejoSesion.inc.php");
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Ejercicio 26 BD ABM</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="addsearch-category" content="Ejercitación Laboratorio 3 - UTN Haedo" />
    <link rel="shortcut icon" href="../../../Recursos/Imagenes/logo_favicon.ico">
    <meta name="author" content="Lautaro Salinas">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
</head>
<body>
    <div id="container" class="activeContainer">
        <header>Articulos</header>
        <main>
            <table id="tabla">
                <thead>
                    <tr id="th-fila-1">
                        <th campo-dato="codigo" id="ordenCodigo">Cod. Art.</th>
                        <th campo-dato="cat" id="ordenCategoria">Categoria</th>
                        <th campo-dato="valor" id="ordenValor">Valor</th>
                        <th campo-dato="descripcion" id="ordenDescripcion">Descripción</th>
                        <th campo-dato="fechaAlta" id="ordenFechaAlta">Fecha Alta</th>
                        <th campo-dato="saldo" id="ordenSaldo">Stock</th>
                        <th campo-dato="edicion" id="ordenEdición">Opc</th>
                    </tr>
                    <tr id="th-fila-2">
                        <th campo-dato="codigo" ><input type="text" id="filtroCodigo"></th>
                        <th campo-dato="cat" ><input type="text" id="filtroCategoria"></th>
                        <th campo-dato="valor" ><input type="text" id="filtroValor"></th>
                        <th campo-dato="descripcion" ><input type="text" id="filtroDescripcion"></th>
                        <th campo-dato="fechaAlta" ><input type="text" id="filtroFechaAlta"></th>
                        <th campo-dato="saldo" ><input type="text" id="filtroSaldo"></th>
                        <th campo-dato="edicion" id="filtroEdición"></th>
                    </tr>
                </thead>
                <tbody id="cuerpoTabla">

                </tbody>
                <tfoot>
                    <tr>
                        <td campo-dato="codigo"></td>
                        <td campo-dato="cat"></td>
                        <td campo-dato="valor" id="footerValor">s valor</td>
                        <td campo-dato="descripcion"></td>
                        <td campo-dato="fechaAlta"></td>
                        <td campo-dato="saldo" id="footerStock">s Stock</td>
                        <td campo-dato="edicion"></td>
                    </tr>
                </tfoot>
            </table>
        </main>
        <footer>
            <div id="totalRegistros"></div></br>
            <p>Pie del Formulario</p>
            <a href="../destruirSesion.php"><button id="btnCierraSesion">Cerrar sesión</button></a>
        </footer>
        <div id="divBotones">
            <button id="btnMostrar">Mostrar</button>
            <button id="btnVaciar">Vaciar</button>
            <button id="btnCargar">Cargar</button>
            <select id="orden"></select>
        </div>
    </div>
    <div id="modalWindow" class="modalWindowDisabled">
        <div class="modalWindowHeader">
            <h3>Encabezado de ventana modal</h3>
            <button class="btnCloseWindow" id="btnCloseWindow"></button>
        </div>
        <div id="mwBody">
            
            <div id="mwHeader">
            </div>
            <form enctype="multipart/form-data" method="POST" id="form">    
                <div class="divInterno">
                    <label for="codArticulo">Código del Artículo</label>
                    <input id="codArticulo" name="codArticulo" type="text" required>
                    <input id="codArticuloOriginal" name="codArticuloOriginal" type="text" hidden readonly>
                </div>
                <div class="divInterno">
                    <label for="desc">Descripción</label>
                    <input id="desc" name="desc" type="text" required>
                </div>
                <div class="divInterno">
                    <label for="stock">Stock</label>
                    <input id="stock" name="stock" type="number" step="1" required required onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
                </div>
                <div class="divInterno">
                    <label for="cat">Categoría</label>
                    <select id="cat" name="cat" required></select>
                </div>
                <div class="divInterno">
                    <label for="valor">Valor</label>
                    <input id="valor" name="valor" type="number" step="1" required onkeydown="if(event.key==='.'){event.preventDefault();}"  oninput="event.target.value = event.target.value.replace(/[^0-9]*/g,'');">
                </div>
                <div class="divInterno">
                    <label for="fechaAlta">Fecha Alta</label>
                    <input id="fechaAlta" name="fechaAlta" type="date" required>
                </div>
                <div class="divInterno">
                    <label for="formPDF">PDF</label>
                    <!-- MAX_FILE_SIZE must precede the file input field -->
                    <input type="hidden" name="MAX_FILE_SIZE" value="3000000" />
                    <input id="formPDF" type="file" name="formPDF">
                </div>
                <div class="divInterno">
                    <button type="button" id="btnSubmit" disabled>Enviar</button>
                </div>
            </form>
        </div>
    </div>
    <div id="modalWindowPDF" class="modalWindowPDFDisabled">
        <div class="modalWindowHeader" >
            <h3>Encabezado de ventana PDF</h3>
            <button class="btnCloseWindow" id="btnCloseWindowPDF"></button>
        </div>
        <div id="mwBodyPDF">
            <div class="ContainerPDF" id="ContainerPDF">
            </div>
        </div>
    </div>
    <div id="PopUpInfo" class="PopUpInfoDisabled">
        <div class="PopUpInfoHeader">
            <h4>Encabezado de PopUp</h4>
            <button class="btnCloseWindowInfo" id="btnCloseWindowInfo"></button>
        </div>
        <div id="PopUpInfoBody"></div>
    </div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script type="module" src="./main.js"></script>
<script src="./columns.js" type="text/javascript"></script>
</body>

</html>