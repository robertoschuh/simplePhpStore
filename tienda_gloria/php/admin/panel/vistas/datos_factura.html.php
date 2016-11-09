<table width="100%" height="342" border="0" cellpadding="4" cellspacing="4" bordercolor="#FFFFFF" >
	<tr>
		<td height="334" valign="top">
			<table>
				<tr>
				<?php
				echo "<a href='$PHP_SELF?imprimir=0&ref=$ref'>$datos_factura</a>";;
				?>
				<td width="27%" valign="top">
					<table width="100%" align='center' cellpadding="2" cellspacing="2" bordercolor="#FFFFFF" bgcolor="#FFFFFF">
						<tr>
							<td> </td>
						</tr>
						<tr><th colspan='5' align='center'>&nbsp;</th></tr>
						<tr><th colspan='5' align='center'>&nbsp;</th></tr>
						<tr><th colspan='5' align='center' style="color:#000">DATOS DE ENVÍO </th></tr>
						<tr><td width="68%" colspan='4'  style="color:#000" ><?php print  $result['name'] ;?> <?php print " ".$result['surname'] ;?></td>
						</tr>
						<tr><td width="68%" colspan='4' style="color:#000" ><?php print  $result['address'];?>          </tr>
						<tr><td colspan='5'  style="color:#000"><?php print $result['city'];?>  -<?php print  $result['zip'];?></td></tr>
						<tr><td colspan='4' style="color:#000" ><?php print $result['state'];?></td></tr>
						<tr><td colspan='4'style="color:#000"><?php print $result['country'];?></td></tr>
						<tr><td class='datos_envio' colspan='4' style="color:#000" > <?php if ($result['telf']!=0) print $result['telf']; ?>
						 Tel&eacute;fono: <?php print $result['movil'];?>            </td>
						</tr>
						<tr><td class='datos_envio' colspan='4' style="color:#000"> Modo de pago:<?php if  ($result['modo']==1)
						print "Transferencia o ingreso";
						else
						print "Contrareembolso"; ?></td>
						</tr>
						<tr>
							<?php print "<td colspan='4' style='color:#000'>
							<a style='color:#000' href='../../mails/mail_confim_existencias.php?email=$result[email]&ref=$ref&portes=".$_SESSION[portes]." ' >
							".$result['email']."</a></td>
							</tr>";?>
						</table>
					</td>
				</tr>
			</table>	
		</td>	
	</tr>
</table>