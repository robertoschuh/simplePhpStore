<?
@session_start();

$admin_user=$_SESSION['admin_user'];

require ("../../fns.php");
require ("../admin_fns.php");

/*Recojemos el catid mediante $_post y lo enviamos a la función delete_cat() para que borre esa categoría con sus 
correspondientes artículos y nos devuelva un mensaje de OK en caso de haberlo hecho correctamente */

$catid=$_POST["cats"];


 if (!session_is_registered("admin_user")) 
   echo "Usted no tiene autorización para ver esto, si es el administrador consulte con el soporte técnico, Gracias2<br>";

else

delete_cat ($catid); 

?>