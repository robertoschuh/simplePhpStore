<link href="../../../gloria.css" rel="stylesheet" type="text/css" />


<?php
include_once ("../../fns.php");
include_once  ("../admin_fns.php");

@session_start();


if ($_SESSION['admin_user'])
{
	//Conseguimos un array con todas los nombres de las categorias y sus catid

	panel_control ();

	$cats_array=get_all_cats();

	if ( !$cats_array )

	echo "No se han encontrado categor?as , si existen categor?as consulte con su administrador. Gracias ";
	$url="add_art.php";
	display_form_add_art ($cats_array,$url) ;
}
else

{
  echo "Usted no tiene autorizaci?n para ver esto, si es el administrador consulte con el soporte t?cnico, Gracias<br>";
 echo "<a href='admin/acces.html'>Volver</a>";


 exit;
}
