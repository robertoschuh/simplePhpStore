<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
@session_start();
require_once ("../../fns.php");
require_once ("../admin_fns.php");
require_once ("../pedidos_fns.php");
require_once ("../stock_fns.php");



if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n.<br>";
 echo "<a href='admin/acces.html'>Volver</a>";

}
else

{
 panel_control ();

//Consulta a la base de datos TODAS las categor?as disponibles
$result=show_categories () ;

//Consulta a la Bd los art?culos con existencias excasas de cada categor?a

?>
<table >
<tr>
<td colspan='4' class="carrito_ver"><h4> STOCK DE LA TIENDA </h4></td>
</tr>
</table>
<?php
//Muestra las categor?as
display_menu_stock($result) ;
}
?>
</body>
</html>
