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
	echo "XTT";
	exit;
}
panel_control ();
if (isset($add) ) {

$add=add_new_art($ref_art,$ref,$items_art);
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


if (isset($ok))  {


	if ( !update_articles_pedido($art) )
 	echo "<p class='msg'>No se han podido actualizar los artículos, 
			disculpe las molestias</p>,<p> inténtelo mas tarde, Graciasw</p>";
	
 	else
 	echo "<p class='msg'>Pedido actualizado correctamente</p>"; 
		
}

 ?>
  <table cellpadding="3" cellspacing="3">
  <tr>
  <td> -1 para BORRARLOS y 0 para ponerlos NULOS</td>
<td><a href="consulta_pedidos.php?ref=<? echo $ref ?>"> Volver al pedido</a> </td>
</tr>

 <form name='edit' action="<?=$PHP_SELF ?>" >
 

 <table border="0" cellpadding="3" cellspacing="3">
 <tr>
 <th colspan="2" align="left"> Pedido Ref: <? echo $ref ?> </th>
 </tr>
 <?
$i=0;

if (isset($article) ){
 foreach ($article as $row){
   echo "<td align='left'><input type='hidden' name='art[$i][0]' value='$row[pedidoid]'></td>";

  echo "<td align='left'><input type='text' name='art[$i][1]' value='$row[unidades]'></td>";
 echo "<td><b>Nombre:</b>$row[nombre]</td>";
 echo "<td><b>Precio:</b>$row[precio]</td> </tr>";
 $i++;
	}
}

?>
<tr > 	
<td colspan="4"><input type="submit" name="ok"  value="ACTUALIZAR PEDIDO"/></td>
</tr>	
			
<input type="hidden" name="ref"  value="<?=$ref ?>"/>	


</form>

</table>
<form name="insert" action="<?=$PHP_SELF ?>">
 <table  >
<tr>
<th> Insertar artículo</th>
</tr>
<tr>
<td>REF artículo</td><td><input type="text" name="ref_art"  /></td></tr>
<td>Cantidad</td><td><input type="text" name="items_art"  /></td></tr>
<td colspan="2" align="left">
<input type="hidden" name="ref"  value="<?=$ref ?>"/>
<input type="submit" name="add"  value="AÑADIR ARTICULO" /></td>
</tr>
	

</table>
</form>


</body>
</html>
