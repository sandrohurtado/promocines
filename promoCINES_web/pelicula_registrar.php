<?php
  require("conf/conf.php");
  require("dao/dao.php");
  require("session.php");
  
  session_start();
  if (!array_key_exists('dni', $_SESSION)) { header("Location: login.php"); }
  
  // Seteando Variables
  if ( !isset($msgok) || trim($msgok) == "" ) $msgok = "";
  if ( !isset($msgerror) || trim($msgerrormsgok) == "" ) $msgerror = "";
 
  // POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $datos = array (
    	'titulo' => trim($_POST['titulo']),
    	'sinopsis' => trim($_POST['sinopsis']),
    	'anoEstreno' => trim($_POST['anoEstreno']),
    	'genero' => trim($_POST['genero']),
    	'clasificacion' => trim($_POST['clasificacion']),
    	'director' => trim($_POST['director']),
    	'reparto' => trim($_POST['reparto']),
    	'estado' => 1
    );
   
    $registrar = registrar ('pelicula-registrar', $datos, '');
    if ( is_array($registrar) ) {
      $name = $_FILES['poster']['name'];
      $sepn = explode ('.', $name);
      $ruta = 'images/peliculas/'.trim($registrar['id']).'.'.$sepn[count($sepn)-1];
      if (move_uploaded_file($_FILES['poster']['tmp_name'], $ruta)) {
        $msgok = "Se registró correctamente.";
      } else {
        $msgok = "Se registró pero no se pudo subir el poster..!!";
      }
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
     location.href ="pelicula_listar.php";
   }
  </script>
 </head>
 <body>
  
  <div class="topnav" id="myTopnav">
   <a href="#pelicula-listar" class="active">PromoCINES</a>
   <?php
     if ( trim($_SESSION['tipo'])=="A" ) {
   ?>
   <a href="usuario_listar.php">Usuarios</a>
   <?php
     }
   ?>
   <a href="logout.php">Cerrar Sesión</a>
   <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i><img src="images/menu.png" border="0"></i>
   </a>
  </div>
 
  <h2>&nbsp;&nbsp;Agregar Película</h2>
  
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
   <form name="form1" action="pelicula_registrar.php" method="POST" enctype="multipart/form-data">
    <div class="row">
     <div class="col-25">
      <label for="titulo">Título</label>
     </div>
     <div class="col-75">
      <input type="text" id="titulo" name="titulo" placeholder="Ingrese título...">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="poster">Poster</label>
     </div>
     <div class="col-75">
      <input type="FILE" name="poster"/>
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="sinopsis">Sinposis</label>
     </div>
     <div class="col-75">
      <textarea id="sinopsis" name="sinopsis" placeholder="Ingrese sinopsis.." style="height:150px"></textarea>
     </div>
    </div>
     
    <div class="row">
     <div class="col-25">
      <label for="anoEstreno">Año estreno</label>
     </div>
     <div class="col-75">
      <input type="text" id="anoEstreno" name="anoEstreno" placeholder="Ingrese año de estreno..">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="genero">Género</label>
     </div>
     <div class="col-75">
      <input type="text" id="genero" name="genero" placeholder="Ingrese género..">
     </div>
    </div>
    
    <div class="row">
      <div class="col-25">
       <label for="clasificacion">Clasificación</label>
      </div>
      <div class="col-75">
       <select id="clasificacion" name="clasificacion">
        <option value="G">G</option>
        <option value="PG">PG</option>
        <option value="PG-13">PG-13</option>
        <option value="R">R</option>
        <option value="NC">NC</option>
        <option value="NR">NR</option>
       </select>
      </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="director">Director</label>
     </div>
     <div class="col-75">
      <input type="text" id="director" name="director" placeholder="Ingrese director..">
     </div>
    </div>
    
    <div class="row">
     <div class="col-25">
      <label for="reparto">Reparto</label>
     </div>
     <div class="col-75">
      <input type="text" id="reparto" name="reparto" placeholder="Ingrese reparto..">
     </div>
    </div>
    <br>
    <div class="row">
     <input type="button" class="eliminar" value="Volver" OnClick="volver();">
     <input type="submit" value="Guardar">
    </div>
   </form>
  </div>
 </body>
</html>
