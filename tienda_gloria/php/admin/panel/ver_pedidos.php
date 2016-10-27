<?php @session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panel de control tienda</title>
<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css' />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../panel.css" rel="stylesheet" type="text/css" />
</head>
 
<body>
<div class="panel">
<?php

require_once ("../../fns.php");
require_once ("../admin_fns.php");
require_once ("../pedidos_fns.php");
require_once ("../render_pedidos_fns.php");

$servidos = $_GET['servidos'];

$url_back = $_SERVER['HTTP_REFERER'];
$admin_user = $_SESSION['admin_user'];
if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorización.<br>";
  echo "<a href='admin/acces.html'>Volver atrás</a>";

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
echo "<div style='align:center'><a href='" . $url_back . "'>Atrás</a></div>";
?>
</div>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../../js/admin.js" type="text/javascript" />
</body>
</html>
