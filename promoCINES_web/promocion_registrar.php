<?php
  require("conf/conf.php");
  require("dao/dao.php");
  require("session.php");
  
  session_start();
  if (!array_key_exists('dni', $_SESSION)) { header("Location: login.php"); }
  
  // Seteando Variables
  if ( !isset($id) || trim($id) == "" ) {
    if ( trim($_GET['id']) )
      $id = trim($_GET['id']);
    else
      $id = trim($_POST['id']);
  }
  if ( !isset($msgok) || trim($msgok) == "" ) $msgok = "";
  if ( !isset($msgerror) || trim($msgerrormsgok) == "" ) $msgerror = "";
 
  // POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = array (
    	'descripcion' => trim($_POST['descripcion']),
    	'iniVigencia' => trim($_POST['iniVigencia']),
    	'finVigencia' => trim($_POST['finVigencia']),
    	'descuento' => trim($_POST['descuento']),
    	'cantidad' => trim($_POST['cantidad']),
    	'stock' => trim($_POST['stock']),
    	'vendidas' => 0,
    	'estado' => 1
    );
   
    $registrar = registrar ('promocion-registrar', $datos, $id);
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
 
  <h2>&nbsp;&nbsp;Registrar Promoción</h2>
  
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
   <form name="form1" action="promocion_registrar.php" method="POST">
   
    <div class="row">
     <div class="col-25">
      <label for="sinopsis">Descripción</label>
     </div>
     <div class="col-75">
      <textarea id="descripcion" name="descripcion" placeholder="Ingrese descripción.." style="height:150px"></textarea>
     </div>
    </div>
     
    <div class="row">
     <div class="col-25">
      <label for="anoEstreno">Inicio Vigencia</label>
     </div>
     <div class="col-75">
      <input type="text" id="iniVigencia" name="iniVigencia" placeholder="Ingrese inicio de vigencia..">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="anoEstreno">Fin Vigencia</label>
     </div>
     <div class="col-75">
      <input type="text" id="finVigencia" name="finVigencia" placeholder="Ingrese fin de vigencia..">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="genero">Descuento</label>
     </div>
     <div class="col-75">
      <input type="text" id="descuento" name="descuento" placeholder="Ingrese descuento..">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="genero">Cantidad de Entradas</label>
     </div>
     <div class="col-75">
      <input type="text" id="cantidad" name="cantidad" placeholder="Ingrese cantidad de entradas..">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="genero">Stock</label>
     </div>
     <div class="col-75">
      <input type="text" id="stock" name="stock" placeholder="Ingrese stock..">
     </div>
    </div>
    
    <br>
    <div class="row">
     <input type="button" class="eliminar" value="Volver" OnClick="volver();">
     <input type="submit" value="Guardar">
    </div>
    <input type="hidden" name="id" value="<?=$id?>">
   </form>
  </div>
 </body>
</html>
