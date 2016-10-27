<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />


<?

@session_start();
require ("../../fns.php");
require ("../admin_fns.php");



if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n para ver esto, si es el administrador consulte con el soporte t?cnico, Gracias<br>";
 echo "<a href='admin/acces.html'>Volver</a>";
}

panel_control ();
$cats_array=get_all_cats(); //Obtenemos array con la lista de todas las categor?as

display_cats_arts_delete ($cats_array, $option="1"); //Mostamos formulario para poder borrar art?culo en concreto
													//inicializamos option a 1 porque se trata de las categorias
													//cuando se trate de los articulos pondremos 2



?>
