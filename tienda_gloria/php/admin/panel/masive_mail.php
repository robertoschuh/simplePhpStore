<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<title>Envio de Mails</title>
</head>

<body>
<?
require ("../admin_fns.php");
require ("../pedidos_fns.php");
require ("../../fns.php");
include("../../idiomas/idiomas_fns.php");

@session_start();

if (!session_is_registered("admin_user")) 
{
  echo "Usted no tiene autorización, si es el administrador consulte con el soporte técnico, Gracias<br>";
 echo "<a href='admin/acces.html'>Volver</a>"; 
 exit; 
}

panel_control ();

masive_mail_form();

if ( $_POST['asunto'] && $_POST['mensaje'] )
{
	$envio_mail=masive_mail( $_POST['asunto'] ,$_POST['mensaje']);
	if ($envio_mail)
		echo "Se ha enviado con éxito a $envio_mail clientes el mail, Gracias.";
	else 
		echo "EL mail NO se ha podido enviar";
}
?>
</body>
</html>
