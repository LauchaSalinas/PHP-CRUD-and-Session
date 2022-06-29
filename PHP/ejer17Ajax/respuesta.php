<?php
        sleep(3);
            echo "<p>Clave: " . $_POST['clave']. "</p>";
            echo "<p>Clave encriptada en MD5 (128 bits o 16 pares hexadecimales):<p>";
            echo md5($_POST['clave']);
            echo "<p>Clave encriptada en SHA1 (160 bits o 20 pares hexadecimales):<p>";
            echo sha1($_POST['clave']);
?>