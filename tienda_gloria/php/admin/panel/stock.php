<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Untitled Document</title>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
@session_start();
require ("../../fns.php");
require ("../admin_fns.php");
require ("../pedidos_fns.php");
require ("../stock_fns.php");



if (!session_is_registered("admin_user")) 
{
  echo "Usted no tiene autorización.<br>";
 echo "<a href='admin/acces.html'>Volver</a>"; 
  
}
else

{
 panel_control ();

//Consulta a la base de datos TODAS las categorías disponibles 
$result=show_categories () ;

//Consulta a la Bd los artículos con existencias excasas de cada categoría

?>
<table >
<tr>
<td colspan='4' class="carrito_ver"><h4> STOCK DE LA TIENDA </h4></td>
</tr>
</table>
<?
//Muestra las categorías
display_menu_stock($result) ;
}
?>
</body>
</html>
