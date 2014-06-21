<?php @session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panel de control tienda</title>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?php

require ("../../fns.php");
require ("../admin_fns.php");
require ("../pedidos_fns.php");
require ("../render_pedidos_fns.php");

$servidos = $_GET['servidos'];

$url_back = $_SERVER['HTTP_REFERER'];
$admin_user = $_SESSION['admin_user'];
if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n.<br>";
  echo "<a href='admin/acces.html'>Volver</a>";

}
else
{
    panel_control ();
   ?>
   <br /><br />
   <?php
   //Muestra los pedidos YA SERVIDOS QUE EST?N ARCHIVADOS EN LA BD
   if ($servidos == 0) {
       ver_pedidos_todos();
   }

   //muestra los pedidos aún NO SERVIDOS
   elseif ($servidos == 1){
       ver_pedidos_servidos();
   }

}
echo "<table align='center'><tr><td><a href='" . $url_back . "'>Atr?s</a></td></tr></table>";
?>

</body>
</html>
