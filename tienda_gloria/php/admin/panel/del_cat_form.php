<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />


<?

@session_start();
require ("../../fns.php");
require ("../admin_fns.php");



if (!session_is_registered("admin_user")) 
{
  echo "Usted no tiene autorización para ver esto, si es el administrador consulte con el soporte técnico, Gracias<br>";
 echo "<a href='admin/acces.html'>Volver</a>";  
}

panel_control ();
$cats_array=get_all_cats(); //Obtenemos array con la lista de todas las categorías

display_cats_arts_delete ($cats_array, $option="1"); //Mostamos formulario para poder borrar artículo en concreto
													//inicializamos option a 1 porque se trata de las categorias
													//cuando se trate de los articulos pondremos 2



?>