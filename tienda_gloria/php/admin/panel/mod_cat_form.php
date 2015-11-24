<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<?php

@session_start();

require ("../../fns.php");
require ("../admin_fns.php");

if (!$_SESSION['admin_user'])
{
  echo "Usted no tiene autorizaci?n.<br>";
 echo "<a href='admin/acces.html'>Volver</a>";
}

 panel_control ();
//Obtenemos la lista entera de categor?as habidas para enviarlas al formulario
$cats=get_categories();

//enviamos la lsita de categor?as al formulario para poder editarlas
mod_cat_form($cats);
