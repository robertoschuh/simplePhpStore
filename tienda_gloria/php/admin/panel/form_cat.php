<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?

@session_start();

if (!session_is_registered("admin_user")) 
{
  echo "Usted no tiene autorización para ver esto, si es el administrador consulte con el soporte técnico, Gracias<br>";
 echo "<a href='admin/acces.html'>Volver</a>";  
}


require ("../../fns.php");
require ("../admin_fns.php");
 
panel_control ();
display_form_add_cat () ;

?>