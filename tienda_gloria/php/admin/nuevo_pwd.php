<link href="../../gloria.css" rel="stylesheet" type="text/css" />
<?
require_once("../fns.php");
require_once("admin_fns.php");


if ($_POST) {
if ( trim($_POST['password'])===trim($_POST['password2']) )
	{
		//Cambiamos su Pwd
		if ( change_pwd (trim($_POST['password']),trim($_POST['email'])) )
		echo "<h3>Se ha modificado con �xito su contrase�a, Gracias</h3>
		<a href='http://www.gloriabotonero.com'>Ir a TIENDA </a>";
		else
		echo "<h3>No se ha podido llevar a cabo su gesti�n, porfavor int�ntelo m�s tarde, Gracias</h3>";
		exit;
	}
else  {
echo "<h3>Las contrase�as no coinciden, por favor vuelva a introducirlas</h3>";
      echo "<a href='javascript:history.back(1)'>Volver Atr�s</a>";
      exit;
	}
}

//comrpobamps que exista petici�n vigente , sino salimos
if ( !comprueba_pet($_GET['coddeerrttyasd'] ) ){
echo "No existe petici�n o ya la ha utilizado para modificar su contrase�a";
echo "<a href='http://www.gloriabotonero.com'><h3>Ir a TIENDA </h3></a>";
exit;
}

//Mostramos el formulario para cambiar el pwd
change_pwd_form () ;
exit;

?>