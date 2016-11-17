<form action="consulta_pedidos.php" method="post" >
	<table align="center">
		<tr>
			<td> Referencia: </td>
			<td><input name="ref" type="text" id="ref" /></td>
		</tr>
		<tr>
			<td><input type="submit" name="Submit" value="Enviar" /></td>
		</tr>
	</table>
</form>
<table align="center">
	<tr>
	<?php
	echo "<td><h3> <a href='ver_pedidos.php?servidos=0 target='_self'> Pedidos Pendientes </a></h3></td> ";
	?>

		<td></td>
		<td></td>
		<?php
		echo "<td><a href='ver_pedidos.php?servidos=1  target='_self'>Pedidos Servidos</a></td>";
		?>
	</tr>
</table>