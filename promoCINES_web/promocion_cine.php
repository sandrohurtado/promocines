<?php
  require("conf/conf.php");
  require("dao/dao.php");
  require("session.php");
  
  session_start();
  
  // Seteando Variables
  if ( !isset($id_pelicula) || trim($id_pelicula) == "" ) {
    if ( trim($_GET['id_pelicula']) )
      $id_pelicula = trim($_GET['id_pelicula']);
    else
      $id_pelicula = trim($_POST['id_pelicula']);
  }
  if ( !isset($codigo_promocion) || trim($codigo_promocion) == "" ) {
    if ( trim($_GET['codigo_promocion']) )
      $codigo_promocion = trim($_GET['codigo_promocion']);
    else
      $codigo_promocion = trim($_POST['codigo_promocion']);
  }
  
  if ( !isset($msgok) || trim($msgok) == "" ) $msgok = "";
  if ( !isset($msgerror) || trim($msgerrormsgok) == "" ) $msgerror = "";
  
  // POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    
  }
?>
<!DOCTYPE html>
<html>
 <head>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" type="text/css" href="css/styles.css">
  <link rel="stylesheet" type="text/css" href="css/menu.css">
  <script>
   function myFunction() {
     var x = document.getElementById("myTopnav");
     if (x.className === "topnav") {
       x.className += " responsive";
     } else {
       x.className = "topnav";
     }
   }
   
   function comprarpromocion (codigo) {
     location.href ="promocion_comprar.php?id=" + document.form1.id_pelicula.value + "&codigo=" + codigo;
   }
   
   function volver () {
     location.href ="promocion_listar.php?id=" + document.form1.codigo_promocion.value;
   }
  </script>
 </head>
 <body>
 
  <div class="topnav" id="myTopnav">
   <a href="#pelicula-listar" class="active">PromoCINES</a>
   <?php
     if ( !array_key_exists('dni', $_SESSION) ) {
   ?>
   <a href="login.php">Iniciar Sesión</a>
   <a href="usuario_registrar.php">Registrarse</a>
   <?php
     } else {
       if ( trim($_SESSION['tipo'])=="A" ) {
   ?>
   <a href="usuario_listar.php">Usuarios</a>
   <?php
       }
   ?>
   ?>
   <a href="logout.php">Cerrar Sesión</a>
   <?php
     }
   ?>
   <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i><img src="images/menu.png" border="0"></i>
   </a>
  </div>
  
  <input type="button" class="guardar" value="Comprar" OnClick="comprarpromocion('<?=$codigo_promocion?>');">
  <input type="button" class="eliminar2" value="Volver" OnClick="volver();">
  
  <h2>&nbsp;&nbsp;Comprar Promocion</h2>
  
  <?php
    if ( trim($msgok) != "" ) {
  ?>
  <div class="message-ok">
   <b><?=$msgok?></b>
  </div>
  <?php
    } else if ( trim($msgerror) != "" ) {
  ?>
  <div class="message-error">
   <b><?=$msgerror?></b>
  </div>
  <?php
    }
  ?>
  
  <div class="container">
   <form name="form1" action="promocion_cine.php" method="POST">
    <iframe width="100%" height="800px" src="https://www.cineplanet.com.pe/peliculas/dumbo?idapp=promoCINES&id_pelicula=<?=$id_pelicula?>&id_promocion=<?=$codigo_promocion?>"></iframe>
    <input type="hidden" name="id_pelicula" value="<?=$id_pelicula?>">
    <input type="hidden" name="codigo_promocion" value="<?=$codigo_promocion?>">
   </form>
  </div>
 </body>
</html>
