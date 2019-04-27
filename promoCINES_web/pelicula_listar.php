<?php
  require("conf/conf.php");
  require("dao/dao.php");
  require("session.php");
  
  session_start();
  
  // Seteando Variables
  if ( !isset($id) || trim($id) == "" ) $id = "";
  if ( !isset($msgok) || trim($msgok) == "" ) $msgok = "";
  if ( !isset($msgerror) || trim($msgerrormsgok) == "" ) $msgerror = "";
  
  // POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eliminar = eliminar ('pelicula-eliminar', trim($_POST['id']), '');
    if ( is_array($eliminar) ) {
      $msgok = "Se eliminó correctamente.";
    } else {
      $msgerror = "Error: No se pudo eliminar la pelicula..!!";
    }
  }
  
  // Listando Peliculas
  $rs_peliculas = listar('peliculas','');
  if ( !is_array($rs_peliculas) ) {
    $msgerror = "Error: No se encontraron peliculas..!!";
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
   
   function preborra (id) {
     msg = 'Confirma que desea eliminar la pelicula?';
     sav = window.confirm (msg);
     (sav)? borra (id) : 'return false';
   }
   
   function borra (id) {
     document.form1.id.value = id;
     document.form1.submit ();
   }
   
   function agregarpelicula () {
     location.href ="pelicula_registrar.php";
   }
   
   function verpromociones (id) {
     location.href ="promocion_listar.php?id=" + id;
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
   <a href="logout.php">Cerrar Sesión</a>
   <?php
     }
   ?>
   <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i><img src="images/menu.png" border="0"></i>
   </a>
  </div>
  
  <?php
    if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])!="U" ) {
  ?>
  <input type="button" class="guardar" value="Agregar" OnClick="agregarpelicula();">
  <?php
    }
  ?>
  <h2>&nbsp;&nbsp;Películas</h2>
  
  
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
   <form name="form1" action="pelicula_listar.php" method="POST">
    <?php
      if ( is_array($rs_peliculas) ) {
        for ($i=0; $i<=count($rs_peliculas)-1; $i++) {
          echo '    <div class="row">'.chr(13).chr(10);
          echo '     <div class="col-100">'.chr(13).chr(10);
          echo '      <img src="images/peliculas/'.trim($rs_peliculas[$i]['id']).'.jpg">'.chr(13).chr(10);
          echo '      <br><label>'.chr(13).chr(10);
          echo '       <h3>'.trim($rs_peliculas[$i]['titulo']).' ('.trim($rs_peliculas[$i]['anoEstreno']).')</h3>'.chr(13).chr(10);
          echo '       '.trim($rs_peliculas[$i]['sinopsis']).'<br>'.chr(13).chr(10);
          echo '       <b>Género:</b> '.trim($rs_peliculas[$i]['genero']).'<br>'.chr(13).chr(10);
          echo '       <b>Clasificación:</b> '.trim($rs_peliculas[$i]['clasificacion']).'<br>'.chr(13).chr(10);
          echo '       <b>Director:</b> '.trim($rs_peliculas[$i]['director']).'<br>'.chr(13).chr(10);
          echo '       <b>Reparto:</b> '.trim($rs_peliculas[$i]['reparto']).'<br>'.chr(13).chr(10);
          echo '      </label><br>'.chr(13).chr(10);
          if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])!="U" ) {
            echo '      <input type="button" class="eliminar" value="Eliminar" OnClick="preborra('."'".trim($rs_peliculas[$i]['id'])."'".');">'.chr(13).chr(10);
          }
          echo '      <input type="button" class="guardar" value="Promociones" OnClick="verpromociones('."'".trim($rs_peliculas[$i]['id'])."'".')">'.chr(13).chr(10);
          echo '     </div>'.chr(13).chr(10);
          echo '    </div><br>'.chr(13).chr(10);
        }
      }
    ?>
    <input type="hidden" name="id" value="">
   </form>
  </div>
 </body>
</html>
