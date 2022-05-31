<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PHP - Ejercicio 6 Formulario</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <meta name="addsearch-category" content="Ejercitación Laboratorio 3 - UTN Haedo" />
    <link rel="shortcut icon" href="../../Recursos/Imagenes/logo_favicon.ico">
    <meta name="author" content="Lautaro Salinas">
    <link rel="stylesheet" type="text/css" href="./style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
</head>
<body>
    <div id='form-container'>
        <form action='./respuesta.php' method='GET'>
            
            <label for='nombre'>Nombre: </label>
            <input type='text' name='nombre' id='nombre'><br><br>
            
            <label for=''apellido>Apellido: </label>
            <input type='text' name='apellido' id='apellido'><br><br>
            
            <button type='submit'>Enviar</button>
        </form>
    </div>

</body>
</html>