<?php
  require("conf/conf.php");
  require("dao/dao.php");
  require("session.php");
  
  session_start();
  if (array_key_exists('dni', $_SESSION)) { header("Location: pelicula_listar.php"); }
  
  // Seteando Variables
  if ( !isset($msgerror) || trim($msgerrormsgok) == "" ) $msgerror = "";
 
  // POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = array (
    	'email' => trim($_POST['email']),
    	'contrasena' => trim($_POST['contrasena'])
    );
   
    $validar = registrar ('usuario-validar-sesion2', $datos, '');
    if ( is_array($validar) ) {
      iniciar_sesion ($validar);
      header("Location: pelicula_listar.php");
    } else {
      $msgerror = "Error: Nombre de usuario y/o contraseña incorrecta..!!";
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
  </script>
 </head>
 <body>
  
  <div class="topnav" id="myTopnav">
   <a href="pelicula_listar.php">PromoCINES</a>
   <a href="#login" class="active">Iniciar Sesión</a>
   <a href="usuario_registrar.php">Registrarse</a>
   <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i><img src="images/menu.png" border="0"></i>
   </a>
  </div>
 
  <h2>&nbsp;&nbsp;Iniciar Sesión</h2>
  
  <?php
    if ( trim($msgerror) != "" ) {
  ?>
  <div class="message-error">
   <b><?=$msgerror?></b>
  </div>
  <?php
    }
  ?>
  
  <div class="container">
   <form name="form1" action="login.php" method="POST">
    <div class="row">
     <div class="col-25">
      <label for="titulo">Email</label>
     </div>
     <div class="col-75">
      <input type="text" id="email" name="email" placeholder="Ingrese email...">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="anoEstreno">Contraseña</label>
     </div>
     <div class="col-75">
      <input type="password" id="contrasena" name="contrasena" placeholder="Ingrese su contrasena...">
     </div>
    </div>
    <br>
    <div class="row">
     <input type="reset" value="Limpiar">
     <input type="submit" value="Enviar">
    </div>
   </form>
  </div>
 </body>
</html>
