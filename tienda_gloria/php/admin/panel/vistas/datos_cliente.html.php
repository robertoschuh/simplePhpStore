<table border='0' width='100%' class='mail'>
		<tr>
			<td colspan='3' class='carrito_ver'><b>Sus datos de envío</b></td>
		</tr>
		<tr bgcolor='#9292C8'>
			<td class="mini_text"> Nombre </td>
			<td class="mini_text"> Dirección</td>
			<td class="mini_text"> Ciudad</td> 	                      
		    <td class="mini_text">Provincia </td><td class="mini_text">CP</td><td class="mini_text"> País</td>
		</tr>
		<tr bgcolor="#CBCED8">
			<td class="mini_text"><?php echo $pedido['name'] ?> </td>
			<td class="mini_text"> <?php echo $pedido['address'] ?></td>
			<td class="mini_text"><?php echo $pedido['city'] ?> </td>
			<td class="mini_text"><?php echo $pedido['state'] ?>  </td>
			<td class="mini_text"> <?php echo $pedido['zip'] ?></td>
			<td class="mini_text"> <?php echo $pedido['country'] ?> </td>
		</tr>
		<tr bgcolor='#9292C8'>
			<td class="mini_text"> Email</td> 
			<td class="mini_text">Teléfono</td> 
			<td class="mini_text"> Movil</td>
			<td class="mini_text"> Fecha</td>
		</tr>
		<tr bgcolor="#CBCED8">
			<td class="mini_text"> <?php echo $pedido['email']; ?></td> 
			<td class="mini_text"><?php echo $pedido['telf'] ?>
		</td>
			<td class="mini_text"> <?php echo $pedido['movil']; ?></td>
			<td class="mini_text"> <?php echo fecha(); ?> </td>
		</tr>
</table>
