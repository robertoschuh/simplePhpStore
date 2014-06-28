<?php @session_start(); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Panel de control tienda</title>
<link href='http://fonts.googleapis.com/css?family=Dosis' rel='stylesheet' type='text/css' />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../panel.css" rel="stylesheet" type="text/css" />

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../../js/admin.js" type="text/javascript" />

</head>
<body>
<?php
require_once ("../../fns.php");
require_once ("../admin_fns.php");

if ($_SESSION['admin_user'])
{
    //Conseguimos un array con todas los nombres de las categorias y sus catid

    panel_control ();

    $cats_array = get_all_cats();

    if ( !$cats_array )

    echo "No se han encontrado categorías , si existen categorías consulte con su administrador. Gracias ";
    $url="add_art.php";
    display_form_add_art ($cats_array,$url) ;
}
else
{
   echo "Usted no tiene autorización para ver esto, si es el administrador consulte con el soporte técnico, Gracias<br>";
   echo "<a href='admin/acces.html'>Volver</a>";
   exit;
}
?>
</body>