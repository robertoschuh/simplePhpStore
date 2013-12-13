<?
@session_start();
require ("../../fns.php");
require ("../pedidos_fns.php");
require ("../admin_fns.php");
include ("upload.php");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-1252" />
<title>Documento sin t&iacute;tulo</title>
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
</head>

<body>
<?
if (!session_is_registered("admin_user")) 
{
	echo " ";
	exit;
}
panel_control ();
if (isset($_POST['add']))  {

$add=add_new_art($_POST['ref_art'],$_POST['ref'],$_POST['items_art']);
if ($add==3)
echo "<p class='msg'>No se ha podido añadir el artículo al pedido, 
	posiblemente se encuentre ya añadido al pedido,</p>
	<p class='msg'> y sino por favor inténtelo más tarde, Gracias</p>";
	 
else if ($add==1)
echo "<p class='ok'>Artículo añadido al pedido $ref, Gracias</p>";

else if ($add==2)
echo "<p class='ok'>PROBLEMAS añadiendo artículo al pedido $ref,por favor inténtelo más tarde, Gracias</p>";

}
if ($_GET['ref'])
	$ref=$_GET['ref'];
else
	$ref=$_POST['ref'];
//Comprobamos si hay artículos en el pedido	
 if (!$article=edit_pedido($ref))
 {
 	echo "<p class='msg'><h3>Pedido vacío, por favor añada artículos</h3></p>";
 	exit;
}


if (isset($_POST['ok']))  {


	if ( !update_articles_pedido($_POST['art']) )
 	echo "<p class='msg'>No se han podido actualizar los artículos, 
			disculpe las molestias</p>,<p> inténtelo mas tarde, Graciasw</p>";
	
 	else
 	echo "<p class='msg'>Pedido actualizado correctamente</p>"; 
		
}
include('vistas/edit_pedido_html.php');
 ?>


</body>
</html>
