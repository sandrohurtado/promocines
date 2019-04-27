<?php
  require("session.php");
  session_start();
  if (!array_key_exists("usrlog", $_SESSION)) { header("Location: login.php"); }
  finalizar_sesion();
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<html>
 <head>
  <meta http-equiv="refresh" content="0;URL=login.php">
 </head>
 <body>
 </body>
</html>
