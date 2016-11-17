<table border="1" width="70%" align="center">
	<tr>
		<td align="center" style="color:#000"><strong>Pedido Ref:</strong>  <strong>  <?php echo $ref; ?></strong> </td>
		<td align="center" style="color:#000"><strong> FECHA</strong><strong>   <?php echo fecha(); ?></strong> 
	</tr>
</table>
<br>
<table border='0' align='center' width="100%">
	<tr>
		<td  align='center'  class='encabezadcos_tablas ' width="7%" style="color:#000">Ref </td>
		<td  align='center' class='encabezadcos_tablas ' style="color:#000" >Nombre</td>
		<td  align='center'  class='encabezadcos_tablas ' style="color:#000">Unidades </td>
		<td  align='center'  class='encabezadcos_tablas ' style="color:#000">Precio </td>
		<td  align='center' class='encabezadcos_tablas '  style="color:#000">Importe</td>
	</tr>
	<?php
	//inicializamos total a 0
	$total=0;
	?>
	<form method="post" action="<? $PHP_SELF ?> " name="form1">
	<?php
	foreach($articles as $row) {
		$artid=$row['artid'] ;

		// Función para saber referencia y datos del artículo.
		$arts_datos = arts_info ($row['artid']);
		if (!$arts_datos) {
			echo "No hay datos<br>";
		}

		$unidades=$row['unidades'];
		if ($unidades == 0) {
			$unidades = "NULO";
		}

		$total+= $arts_datos['art_price']*$unidades ;

		//Guardamos las unidades y la Id del art�culo en un array
		$arts_unidades_array[$artid] = $unidades;
		if ( !$_SESSION['arts_unidades_array']){
		  $_SESSION['arts_unidades_array'] = $arts_unidades_array;
		}
	?>
	<tr>
		<?php
		if ( !$_POST['ref'] ){
		?>
		<td width="7%" class="items"><div align="center">
		<?php echo $arts_datos['ref'] ?></div></td>
		<?php
		}
		else{
	    ?>
	    <td width="30%" class="items"><div align="center">
	    <?php $_POST['ref'] ?></div></td>
	    <?php
		}
		if ( !$_POST['name'] ){
		    
		    ?>
		    <td width="30%" class="items"><div align="center">
		           <?php print $row['nombre'] ;?></div></td>
		    <?php
		}
		else{
		    ?>
		    <td width="10%" class="items"><div align="center"><?php print $row['nombre']; ?>/div></td>
		    <?php
		}
		if ( !$_POST['unidades'] ){
		?>
		    <td width="20%"><div align="center"><?php print $unidades ?></div></td>
		    <?php
		}
		else{
		?>
		    <td width="20%"><div align="center"><?php print $_POST['unidades']; ?></div></td>
		    <?php
		}
		if ( !$_POST['price'] ){
		?>
		    <td width="20%"><div align="center"><?php echo redondear_dos_decimal($arts_datos['art_price']); ?> </div></td>
		    <?php
		}
		else{
		?>
		    <td width="20%"><div align="center"><?php  print redondear_dos_decimal($arts_datos['art_price']);?></div></td>
		    <?php
		}
		if ( !$_POST['price_tot'] ){
		?>
		    <td width="20%"><div align="center"><?php  print redondear_dos_decimal($arts_datos['art_price']*$unidades); ?></div></td>
		    <?php
		}
		else { ?>
		    <td width="20%"><div align="center"><?php print $_POST['price_tot']*$unidades; ?>"</div></td>
		<?php }?>
		</tr>
		<tr><td colspan="8"> <hr /> </td></tr>
	<?php }//fin foreach ?>

	<tr>
		<td  colspan="4"  align="right" class="items" style="color:#000">Suma: </td>
		<td align='right'  class="precio" style="color:#000">
		<?php echo  redondear_dos_decimal($total); ?>  &euro;
	</td>
	</tr>
	<tr>
		<td  colspan="4"  align="right" class="items" style="color:#000" >Portes: </td>
		<td align="right"  class="precio" style="color:#000" >
		<?php echo  $_SESSION['portes']; 
		//$total_pagar=calcula_total($total,$_SESSION['portes']);
		 $total_pagar=$total+$_SESSION['portes'];

		//$base_imponible=$total_pagar/1.18;
		$base_imponible=$total_pagar/1.21; //cambiamos al 21%
		$iva = $total_pagar - $base_imponible;

		?>
		</td>
	</tr>

		<td  colspan="4"  align="right" class="items" style="color:#000" >Importe Total : </td>
		<td align='right'  class="precio" style="color:#000">
	<?php echo redondear_dos_decimal($total_pagar) ?> &euro;
		</td>
	</tr>
	<tr>
		<td  colspan="4"  align="right" class="items" style="color:#000" >IVA aplicado 21% : </td>
        <td align='right'  class="precio"  style="color:#000">
       <?php echo $iva=redondear_dos_decimal($iva); ?> &euro; </td>
     </tr>
</table>

     <br /><br />
<table>
	 
	<tr><td></td></tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
	<tr><td></td></tr>
</table>

<table border='0' align='center' width="100%">
		<tr>
		<?php
		if ( $_GET['imprimir']!=1 ){
		?>
		<td align='left' ><a href='consulta_pedidos.php' style="color:#000"> Ver Más Pedidos </a></td>
		<?php }
		
		if ($_GET['imprimir']!=1){
		?>
			<td align='left'  >	<a href='#'  onclick='AbreVentanaPortes() ;' style="color:#000">
			 Insertar Portes</a> </td>

		<td align='right' >	<a href='retraer_stock.php?ref=$ref' style="color:#000">
			 RETRAER STOCK </a> </td>
	<?php	}?>
		</tr>

	 <tr>
		 <td align='left' style="color:#000"><font size="-4" >La mercancía enviada por Gloria Botonero mediante la agencia Tourline Express está asegurada. Cualquier rotura o desperfecto causado durante el transporte, deberá ser comunicado a Gloria Botonero en un plazo máximo de 24 horas desde la recepción del paquete, de lo contrario se entenderá que se ha recibido en perfecto estado y no procederá la reclamación de la misma."
		"La mercancía que viaje por otro medio de transporte, será responsabilidad del cliente".</font>
		</td>
	</tr>
</table>