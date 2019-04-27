<?php

  function sesion_activa() {
    if ( isset($_SESSION['dni']) )
      return true;
    else
      return false;
  }

  function iniciar_sesion($usuario) {
    if (sesion_activa()) {
      finalizar_sesion();
      session_start();
    }
    
    $_SESSION['dni'] = $usuario['dni'];
    $_SESSION['nombres'] = $usuario['nombres'];
    $_SESSION['apellidos'] = $usuario['apellidos'];
    $_SESSION['email'] = $usuario['email'];
    $_SESSION['tipo'] = $usuario['tipo'];
  }

  function finalizar_sesion() { session_destroy(); }
  
?>
