<link href="../../gloria.css" rel="stylesheet" type="text/css" />
<?
require_once("../fns.php");
require_once("admin_fns.php");


if ($_POST) {
if ( trim($_POST['password'])===trim($_POST['password2']) )
	{
		//Cambiamos su Pwd
		if ( change_pwd (trim($_POST['password']),trim($_POST['email'])) )
		echo "<h3>Se ha modificado con éxito su contraseña, Gracias</h3>
		<a href='http://www.gloriabotonero.com'>Ir a TIENDA </a>";
		else
		echo "<h3>No se ha podido llevar a cabo su gestión, porfavor inténtelo más tarde, Gracias</h3>";
		exit;
	}
else  {
echo "<h3>Las contraseñas no coinciden, por favor vuelva a introducirlas</h3>";
      echo "<a href='javascript:history.back(1)'>Volver Atrás</a>";
      exit;
	}
}

//comrpobamps que exista petición vigente , sino salimos
if ( !comprueba_pet($_GET['coddeerrttyasd'] ) ){
echo "No existe petición o ya la ha utilizado para modificar su contraseña";
echo "<a href='http://www.gloriabotonero.com'><h3>Ir a TIENDA </h3></a>";
exit;
}

//Mostramos el formulario para cambiar el pwd
change_pwd_form () ;
exit;

?>