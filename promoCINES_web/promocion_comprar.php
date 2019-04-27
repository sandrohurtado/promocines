<?php
  require("conf/conf.php");
  require("dao/dao.php");
  require("session.php");
  
  session_start();
  
  // Seteando Variables
  if ( !isset($msgok) || trim($msgok) == "" ) $msgok = "";
  if ( !isset($msgerror) || trim($msgerrormsgok) == "" ) $msgerror = "";
 
  // GET
  if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $id = trim($_GET['id']);
    $codigo = trim($_GET['codigo']);
    
    $rs_pelicula = listar('pelicula', $id);
    $rs_promocion = listar('promocion', $codigo);
    
    $promocion = array (
    	'descripcion' => trim($rs_promocion['descripcion']),
    	'iniVigencia' => trim($rs_promocion['iniVigencia']),
    	'finVigencia' => trim($rs_promocion['finVigencia']),
    	'descuento' => trim($rs_promocion['descuento']),
    	'cantidad' => trim($rs_promocion['cantidad']),
    	'stock' => trim($rs_promocion['stock']),
    	'estado' => trim($rs_promocion['estado']),
    );
    
    $datos = array (
    	'id' => trim($rs_pelicula['id']),
    	'titulo' => trim($rs_pelicula['titulo']),
    	'estado' => trim($rs_pelicula['estado']),
    	'promociones' => $promocion
    );
    
    $comprar = registrar ('comprar', $datos, '');
    if ( is_array($comprar) ) {     
      $estado = trim($comprar['estado']);
      if ( $estado == "2" ) {
        $actualizar = eliminar ('promocion-actualizar', $id, $codigo);
        if ( is_array($actualizar) ) {
          $msgok = "Su compra se registró correctamente.";
        } else {
          $msgerror = "Error: No se pudo registrar su compra..!!";
        }
      } else {
        $msgerror = "Error: No se pudo registrar su compra..!!";
      }
    } else {
      $msgerror = "Error: No se pudo registrar su compra..!!";
    }
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
   
   function volver () {
     location.href ="promocion_listar.php?id=" + document.form1.id.value;
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
 
  <h2>&nbsp;&nbsp;Comprar Promoción</h2>
  
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
   <form name="form1" action="promocion_comprar.php" method="POST">
    <div class="row">
     <input type="button" class="eliminar" value="OK" OnClick="volver();">
    </div>
    <input type="hidden" name="id" value="<?=$id?>">
   </form>
  </div>
 </body>
</html>
