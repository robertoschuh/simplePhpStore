<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
</head>

<body>

<?
@session_start();
require ("../../fns.php");
require ("../admin_fns.php");
require ("../pedidos_fns.php");

$servidos=$_GET['servidos'];

$url_back=$_SERVER['HTTP_REFERER'];
$admin_user=$_SESSION['admin_user']; 
if (!session_is_registered("admin_user")) 
{
  echo "Usted no tiene autorización.<br>";
 echo "<a href='admin/acces.html'>Volver</a>"; 
  
}
else
{
 panel_control ();
?>
<br /><br />
<?
//Muestra los pedidos YA SERVIDOS QUE ESTÁN ARCHIVADOS EN LA BD
	if ($servidos==0)
	{
ver_pedidos_todos();
	}

//muestra los pedidos aún NO SERVIDOS
elseif ($servidos==1)
	ver_pedidos_servidos();


}
echo "<table align='center'><tr><td><a href='$url_back'>Atrás</a></td></tr></table>";
?>
</body>
</html>
