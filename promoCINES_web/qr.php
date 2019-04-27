<?php
  // Llamando a la libreria PHPQRCODE
  include('phpqrcode/qrlib.php');

  // Ingresamos el contenido de nuestro Código QR
  $contenido = "http://192.168.1.8/promoCINES_web/pelicula_listar.php";

  // Exportamos una imagen llamado qr.png que contendra el valor de la variable $content
  QRcode::png($contenido,"images/peliculas/qr.png",QR_ECLEVEL_L,6,2);

  // Impresión de la imagen en el navegador listo para usarla
  
  echo "<center>
         <br><br>
         <h1>¿Quieres ir al Cine?</h1>
         <div><img src='images/peliculas/qr.png' width='500px' height='500px'/></div>
        </center>
       ";
?>
