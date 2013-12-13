<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?

@session_start();

require ("../../fns.php");
require ("../admin_fns.php");

if (!session_is_registered("admin_user")) 
{
  echo "Usted no tiene autorización.<br>";
 echo "<a href='admin/acces.html'>Volver</a>";  
}

 panel_control ();
//Obtenemos la lista entera de categorías habidas para enviarlas al formulario
$cats=get_categories();

//enviamos la lsita de categorías al formulario para poder editarlas
mod_cat_form($cats);
?>

