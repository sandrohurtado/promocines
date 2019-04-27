<?php
  require("conf/conf.php");
  require("dao/dao.php");
  require("session.php");
  
  session_start();
  
  // Seteando Variables
  if ( !isset($id) || trim($id) == "" ) {
    if ( trim($_GET['id']) )
      $id = trim($_GET['id']);
    else
      $id = trim($_POST['id']);
  }
  if ( !isset($codigo) || trim($codigo) == "" ) $codigo = "";
  if ( !isset($msgok) || trim($msgok) == "" ) $msgok = "";
  if ( !isset($msgerror) || trim($msgerrormsgok) == "" ) $msgerror = "";
  
  // POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eliminar = eliminar ('promocion-eliminar', trim($_POST['id']), trim($_POST['codigo']));
    if ( is_array($eliminar) ) {
      $msgok = "Se eliminó correctamente.";
    } else {
      $msgerror = "Error: No se pudo eliminar la promocion..!!";
    }
  }
  
  // Listando Promociones
  $rs_promociones = listar('promociones', $id);
  if ( !is_array($rs_promociones) ) {
    $msgerror = "Error: No se encontraron promociones..!!";
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
   
   function preborra (codigo) {
     msg = 'Confirma que desea eliminar la promocion?';
     sav = window.confirm (msg);
     (sav)? borra (codigo) : 'return false';
   }
   
   function borra (codigo) {
     document.form1.codigo.value = codigo;
     document.form1.submit ();
   }
   
   function agregarpromocion (id) {
     location.href ="promocion_registrar.php?id=" + id;
   }
   
   function comprarpromocion (codigo) {
     location.href ="promocion_cine.php?id_pelicula=" + document.form1.id.value + "&codigo_promocion=" + codigo;
   }
   
   function volver () {
     location.href ="pelicula_listar.php";
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
  
  
  <?php
    if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])!="U" ) {
  ?>
  <input type="button" class="guardar" value="Agregar" OnClick="agregarpromocion('<?=$id?>');">
  <?php
    }
  ?>
  <input type="button" class="eliminar2" value="Volver" OnClick="volver();">
  
  <h2>&nbsp;&nbsp;Promociones</h2>
  
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
   <form name="form1" action="promocion_listar.php" method="POST">
    <?php
      if ( is_array($rs_promociones) ) {
        for ($i=0; $i<=count($rs_promociones)-1; $i++) {
          echo '    <div class="row">'.chr(13).chr(10);
          echo '     <div class="col-100">'.chr(13).chr(10);
          echo '      <label>'.chr(13).chr(10);
          echo '       <h3>'.trim($rs_promociones[$i]['descripcion']).'</h3>'.chr(13).chr(10);
          echo '       <b>Ini.vigencia:</b> '.trim($rs_promociones[$i]['iniVigencia']).'<br>'.chr(13).chr(10);
          echo '       <b>Fin vigencia:</b> '.trim($rs_promociones[$i]['finVigencia']).'<br>'.chr(13).chr(10);
          echo '       <b>Descuento:</b> '.trim($rs_promociones[$i]['descuento']).'%<br>'.chr(13).chr(10);
          echo '       <b>Cantidad:</b> '.trim($rs_promociones[$i]['cantidad']).' Entradas<br>'.chr(13).chr(10);
          echo '       <b>Stock:</b> '.trim($rs_promociones[$i]['stock']).' Promociones<br>'.chr(13).chr(10);
          echo '      </label><br>'.chr(13).chr(10);
          if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])!="U" ) {
            echo '      <input type="button" class="eliminar" value="Eliminar" OnClick="preborra('."'".trim($rs_promociones[$i]['codigo'])."'".');">'.chr(13).chr(10);
          } else {
            echo '      <input type="button" class="guardar" value="Comprar" OnClick="comprarpromocion('."'".trim($rs_promociones[$i]['codigo'])."'".');">'.chr(13).chr(10);
          }
          echo '     </div>'.chr(13).chr(10);
          echo '    </div><br>'.chr(13).chr(10);
        }
      }
    ?>
    <input type="hidden" name="id" value="<?=$id?>">
    <input type="hidden" name="codigo" value="">
   </form>
  </div>
 </body>
</html>
