
 <table cellpadding="3" cellspacing="3">
  <tr>
  <td> -1 para BORRARLOS y 0 para ponerlos NULOS</td>
<td><a href="consulta_pedidos.php?ref=<? echo $ref ?>"> Volver al pedido</a> </td>
</tr>

 <form name='edit' action="<?=$PHP_SELF ?>" method="post" >
 

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
<form name="insert" action="<?=$PHP_SELF ?>" method="post">
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

