<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?

@session_start();

if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n para ver esto, si es el administrador consulte con el soporte t?cnico, Gracias<br>";
 echo "<a href='admin/acces.html'>Volver</a>";
}


require ("../../fns.php");
require ("../admin_fns.php");

panel_control ();
display_form_add_cat () ;
