<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

</head>

<body>
<?php
@session_start();
require ("../../fns.php");
require ("../admin_fns.php");
require ("../pedidos_fns.php");
//Enviamos los pedidos que ya se han cobrado a una tabla de la bd para poder acceder a ellos en un futuro

$admin_user=$_SESSION['admin_user'];
if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n.<br>";
  echo "<a href='admin/acces.html'>Volver</a>";

}
else
{
 panel_control ();
$ref=$_GET['ref'];
$option=$_GET['option'];
if ($option==1)
{
$conn = db_connect();
 $query = "DELETE from pedidos_articulos
             WHERE ref='$ref'";
   $result = @mysql_query($query);
   if (!$result)
     echo "<center>No se ha podido borrar, disculpe las molestias</center><br> $ref";
   else
    echo "<center>Pedido Borrado correctamente</center><br>";

}

else
echo "<center>Ok elija otra opci?n del panel de control (arriba)</center>";
?>

<?php
}

?>
</body>
</html>
