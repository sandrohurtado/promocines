<?php
  require("conf/conf.php");
  require("dao/dao.php");
  require("session.php");
  
  session_start();
  if ( !array_key_exists('dni', $_SESSION) || trim($_SESSION['tipo'])!="A" ) { header("Location: pelicula_listar.php"); }
  
  // Seteando Variables
  if ( !isset($id) || trim($id) == "" ) $id = "";
  if ( !isset($msgok) || trim($msgok) == "" ) $msgok = "";
  if ( !isset($msgerror) || trim($msgerrormsgok) == "" ) $msgerror = "";
  
  // Tipos de Usuario
  $tipo_u['A'] = "Administrador";
  $tipo_u['C'] = "Cine";
  $tipo_u['U'] = "Usuario";
  
  // POST
  if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $eliminar = eliminar ('usuario-eliminar', trim($_POST['id']), '');
    if ( is_array($eliminar) ) {
      $msgok = "Se eliminó correctamente.";
    } else {
      $msgerror = "Error: No se pudo eliminar el usuario..!!";
    }
  }
  
  // Listando Usuarios
  $rs_usuarios = listar('usuarios','');
  if ( !is_array($rs_usuarios) ) {
    $msgerror = "Error: No se encontraron usuarios..!!";
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
     msg = 'Confirma que desea eliminar el usuario?';
     sav = window.confirm (msg);
     (sav)? borra (id) : 'return false';
   }
   
   function borra (id) {
     document.form1.id.value = id;
     document.form1.submit ();
   }
   
   function agregarusuario () {
     location.href ="usuario_registrar.php";
   }
  </script>
 </head>
 <body>
 
  <div class="topnav" id="myTopnav">
   <a href="pelicula_listar.php">PromoCINES</a>
   <a href="#usuario_listar" class="active">Usuarios</a>
   <a href="logout.php">Cerrar Sesión</a>
   <a href="javascript:void(0);" class="icon" onclick="myFunction()">
    <i><img src="images/menu.png" border="0"></i>
   </a>
  </div>
  
  
  <?php
    if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])=="A" ) {
  ?>
  <input type="button" class="guardar" value="Agregar" OnClick="agregarusuario();">
  <?php
    }
  ?>
  <h2>&nbsp;&nbsp;Usuarios</h2>
  
  
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
   <form name="form1" action="usuario_listar.php" method="POST">
    <?php
      if ( is_array($rs_usuarios) ) {
        for ($i=0; $i<=count($rs_usuarios)-1; $i++) {
          echo '    <div class="row">'.chr(13).chr(10);
          echo '     <div class="col-100">'.chr(13).chr(10);
          echo '      <label>'.chr(13).chr(10);
          echo '       <b>'.strtoupper(trim($rs_usuarios[$i]['apellidos'])).', '.trim($rs_usuarios[$i]['nombres']).'</b><br>'.chr(13).chr(10);
          echo '       <b>Dni:</b> '.trim($rs_usuarios[$i]['dni']).'<br>'.chr(13).chr(10);
          echo '       <b>email:</b> '.trim($rs_usuarios[$i]['email']).'<br>'.chr(13).chr(10);
          echo '       <b>tipo:</b> '.$tipo_u[trim($rs_usuarios[$i]['tipo'])].'<br>'.chr(13).chr(10);
          echo '      </label><br>'.chr(13).chr(10);
          if ( array_key_exists('dni', $_SESSION) && trim($_SESSION['tipo'])!="U" && trim($rs_usuarios[$i]['tipo'])!="A" ) {
            echo '      <input type="button" class="eliminar" value="Eliminar" OnClick="preborra('."'".trim($rs_usuarios[$i]['id'])."'".');">'.chr(13).chr(10);
          }
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
