<?php
@session_start();
require ("../admin_fns.php");
require ("../pedidos_fns.php");
require ("../../fns.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Gloria Botonero</title>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<script language="JavaScript">

function CierraVentana() {

window.close();
}
function AbreVentanaPortes()  {
    //sustituir ejemplo.html por la ruta y nombre de la pagina a cargar en la ventana
    window.open("inserta_portes.php?sid=<?php echo $sid;?>","" ,"" ,"width=40,heigth=20")
}
</script>
</head>

<body>
<?php
if (!$_GET['ref'])
$ref=$_POST['ref'];

else
$ref=$_GET['ref'];

$servido=$_GET['opcion'];

//$admin_user=$_SESSION['admin_user']; 


if (!session_is_registered('admin_user')) 
{
  echo "Usted no tiene autorizaci�n para ver esto, si es el administrador consulte con el soporte t�cnico, Gracias<br>";
 echo "<a href='admin/acces.html'>Volver</a>"; 
  
}
else
{ 
	if ($_GET['imprimir']!=1  )

 panel_control ();
 //no hay datos de variables ni $_post ni $_get
if (!$HTTP_POST_VARS && !$_GET['ref'] ) 

form_consultar_pedido();

else
	{
	
	consultar_pedido($ref,$servido);
	
	$precio_total=precio_pedido($ref);
	
		//dias_demora($ref,$precio_total);	

	}

}
?>
</body>
</html>
