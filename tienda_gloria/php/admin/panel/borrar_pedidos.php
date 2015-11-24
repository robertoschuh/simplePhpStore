<link href="../../../gloria.css" rel="stylesheet" type="text/css" />


<?


@session_start();
require ("../../fns.php");
require ("../admin_fns.php");
require ("../pedidos_fns.php");

panel_control ();
$ref=$_GET['ref'];
$option=$_GET['option'];

pregunta_borrar($ref,$option);


?>