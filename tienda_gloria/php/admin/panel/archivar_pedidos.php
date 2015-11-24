<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?
@session_start();
require ("../../fns.php");
require ("../admin_fns.php");
require ("../pedidos_fns.php");


$ref=$_GET['ref'];
 panel_control ();

$result=pedidos_servidos($ref);

if (!$result)
echo "No se ha podido archivar su pedido , porfavor consulte a su soporte técnico, Gracias";

else

echo "Pedidos archivado en la Base de Datos, Gracias";


?>
