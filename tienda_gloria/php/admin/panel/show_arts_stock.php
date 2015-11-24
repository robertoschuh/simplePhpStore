<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Articles stock</title>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?php
@session_start();

require_once ("../../fns.php");
require_once ("../admin_fns.php");
require_once ("../stock_fns.php");


 
 //Seleccionamos TODOS los articulos de una categor�a determinada
$art_array=get_arts_almacen($_GET['catid']);
if (!$art_array)
{
	echo "No hay ariculos en excaseces<br>";
	echo " <a href='javascript:history.back(-1)'>Volver</a><br>";

	exit;
}
?>
<table align="center">
<tr>
<td align="center"> <?php panel_control (); ?></td>
</tr>
 <tr>
 <td align="center"><a href='stock.php' > Atrás </a>  </td>
 </tr>
 <tr>
 <td align="center"> <?php display_arts_stock($art_array); ?> </td>
 </tr>

 </table>
 

</body>
</html>
