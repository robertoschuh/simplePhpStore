<?php
echo "<div class='articulos'><td width='150px'> <table align='center' bgcolour='yellow'><tr><td  width='100%'>".$title."</td>	       </tr>
<tr><td  align='center' align='center' class='nombre' >".utf8_encode($name)."</td></tr>
		<tr ><td class='ref' align='center'>Ref: ".$ref."</td></tr>
	    <tr><td> <a href=".$url." class='images_links'><img src=../../tienda_gloria/php/admin/panel/img/arts/peq/".$img." class='img_med' alt=$name> 	         </a></td> </tr>
		<tr><td class='descript' ><a href=$url class='ampliar'>Ampliar</a></td> </tr>
		<tr><td class='descript'>".$details_short."</td> </tr>
		<tr><td class='precio'>$cost: ".number_format($price,2)."  &euro;</td> </tr>";
					
				/*	if(session_is_registered("admin_user") )
						{	*/
							if ($existencias['unidades'] == 0 )
							echo "<tr><td class='agotado' class='agotado'>Agotado temporalmente</td> </tr>";
							/*else
							echo "<tr><td class='agotado'>Existencias: ". $existencias['unidades']."</td> </tr>";*/
						
					/*	} */
					else
					echo "<tr><td class='agotado'><br> </td> </tr>";
					
					if(isset($_SESSION["admin_user"]) )
					echo "<tr><td class='agotado'>Existencias: ". $existencias['unidades']."</td> </tr>";

				if(isset($_SESSION["admin_user"]) )
				if ($cat == 2) //si estamos en novedades
				echo "<tr><td align='center'>
							<a href='admin/panel/mod_art_form.php?artid=$row[artid]&ref=$ref&catid=$row[catid]&cat=2' 	  		       						class='modificar'> Modificar</a> </td> </tr>";
				else
				echo "<tr><td align='center'>
							<a href='admin/panel/mod_art_form.php?artid=$row[artid]&ref=$ref&catid=$row[catid]' 	  		       						class='modificar'> Modificar</a> </td> </tr>";

				else if (!isset($_SESSION["admin_user"]) )
				echo "<td  align='center'><a href='../carrito_php/mete_producto.php?catid=$cat&nombre=$name&id=$row[artid]&precio=$row[art_price]
				&img=$img&ref=$ref'
				class='anadir_cesta'>".$comprar."</a></td>";
				
				
			echo "
			</table>
			
			</td>
			</div>
			";
			
		if ($i===4)
		{
			echo "</tr><tr><td></td></tr><tr><td></td></tr><tr> ";
			
			$i=0; /*pone el contador a 0 una vez haya saltado de linea para que vuelva a sumar otros 3 art�culos antes de saltar a la 			                   siguiente linea */
		}
		else
		$i++; 