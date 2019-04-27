<?php
  require("conf/conf.php");
  require("dao/dao.php");
  require("session.php");
  
  session_start();
  if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])=="U" ) { header("Location: pelicula_listar.php"); }
  
  // Seteando Variables
  if ( !isset($msgok) || trim($msgok) == "" ) $msgok = "";
  if ( !isset($msgerror) || trim($msgerrormsgok) == "" ) $msgerror = "";
 
  // POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])=="A" ) {
      $tipo_u = trim($_POST['tipo_u']);
    } else {
      $tipo_u = "U";
    }
  
    $datos = array (
    	'dni' => trim($_POST['dni_u']),
    	'nombres' => trim($_POST['nombres_u']),
    	'apellidos' => trim($_POST['apellidos_u']),
    	'email' => trim($_POST['email_u']),
    	'contrasena' => trim($_POST['contrasena_u']),
    	'tipo' => $tipo_u,
    	'estado' => 1
    );
   
    $registrar = registrar ('usuario-registrar', $datos, '');
    if ( is_array($registrar) ) {
      $msgok = "Se registró correctamente.";
    } else {
      $msgerror = "Error: No se pudo registrar..!!";
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
     <?php
       if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])=="A" ) {
     ?>
     location.href ="usuario_listar.php";
     <?php
       } else {
     ?>
     location.href ="pelicula_listar.php";
     <?php
       }
     ?>
   }
  </script>
 </head>
 <body>
  
  <div class="topnav" id="myTopnav">
   <a href="pelicula_listar.php">PromoCINES</a>
   <?php
     if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])=="A" ) {
   ?>
   <a href="#usuario_listar" class="active">Usuarios</a>
   <a href="logout.php">Cerrar Sesión</a>
   <?php
     } else {
   ?>
   <a href="login.php">Iniciar Sesión</a>
   <a href="#usuario_registrar" class="active">Registrarse</a>
   <?php
     }
   ?>
   <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i><img src="images/menu.png" border="0"></i>
   </a>
  </div>
 
  <?php
    if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])=="A" ) {
  ?>
  <h2>&nbsp;&nbsp;Registrar Usuario</h2>
  <?php
    } else {
  ?>
  <h2>&nbsp;&nbsp;Registrarse</h2>
  <?php
    }
  ?>
  
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
   <form name="form1" action="usuario_registrar.php" method="POST">
    <div class="row">
     <div class="col-25">
      <label for="dni_u">Dni</label>
     </div>
     <div class="col-75">
      <input type="text" id="dni_u" name="dni_u" placeholder="Ingrese dni...">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="nombres_u">Nombre(s)</label>
     </div>
     <div class="col-75">
      <input type="text" id="nombres_u" name="nombres_u" placeholder="Ingrese su(s) nombre(s)..">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="apellido_u">Apellidos</label>
     </div>
     <div class="col-75">
      <input type="text" id="apellidos_u" name="apellidos_u" placeholder="Ingrese sus apellidos..">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="email_u">Email</label>
     </div>
     <div class="col-75">
      <input type="text" id="email_u" name="email_u" placeholder="Ingrese su email..">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="contrasena_u">Contraseña</label>
     </div>
     <div class="col-75">
      <input type="password" id="contrasena_u" name="contrasena_u" placeholder="Ingrese su contrasena..">
     </div>
    </div>
    <?php
      if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])=="A" ) {
    ?>
    <div class="row">
      <div class="col-25">
       <label for="tipo_u">Tipo</label>
      </div>
      <div class="col-75">
       <select id="tipo_u" name="tipo_u">
        <option value="C">Cine</option>
        <option value="U">Usuario</option>
       </select>
      </div>
    </div>
    <?php
      }
    ?>
    <br>
    <div class="row">
     <input type="button" class="eliminar" value="Volver" OnClick="volver();">
     <input type="submit" value="Guardar">
    </div>
   </form>
  </div>
 </body>
</html>
