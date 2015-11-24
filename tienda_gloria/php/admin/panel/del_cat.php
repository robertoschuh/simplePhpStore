<?
@session_start();

$admin_user=$_SESSION['admin_user'];

require ("../../fns.php");
require ("../admin_fns.php");

/*Recojemos el catid mediante $_post y lo enviamos a la funci?n delete_cat() para que borre esa categor?a con sus
correspondientes art?culos y nos devuelva un mensaje de OK en caso de haberlo hecho correctamente */

$catid=$_POST["cats"];


 if (!$_SESSION['admin_user'])
   echo "Usted no tiene autorizaci?n para ver esto, si es el administrador consulte con el soporte t?cnico, Gracias2<br>";

else

delete_cat ($catid);

?>
