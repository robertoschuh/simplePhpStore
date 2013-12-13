<?php
//CONTANTES 

//datos facturas

$articulos_por_page=25;
$datos_factura="<table width='100%' align='center' cellpadding='2' cellspacing='2'  > 


<tr>
<td width='20%'>
<img src='../../../img/FACTURA.jpg' alt='logo' />
</td>
</tr>
</table>";

//datos imagenes
$size=450;
$size_peq=120;
$destino = 'img/arts' ;
$destino_peq= 'img/arts/peq';

//Variable para modificar sin tocar resto de código 

//Url de envio para cambiar contraseña


$mail_webmaster="gloriabotonero@gmail.com";
//$mail_webmaster="robbyschuh@gmail.com"; para pruebas


$pedidos_mail="gloriabotonero@gmail.com";

$texto_se_ha_enviado_mail="
<h4><font color='blue'>Estimado cliente:</h4></font><br>
<p>Su pedido se ha enviado correctamente :</p>
<p>En breve nos pondremos en contacto con Vd. para darle la informaci&oacute;n detallada de su compra.<p>
<p>No realice ning&uacute;n pago ahora.</p>
<p>Sus datos son los siguientes:</p>
<p><b>Pedido nº $ref </b>de fecha $date</p>
$pedido <table align='left' width='100%'>
		<tr> <th align='right' colspan='3'>Total: $total 	</th></tr>	
		<tr>
		<td><font color='blue'>Sus Comentarios:<br></font></td>
		<td> </td><td> </td>
		 </tr>
		<tr>
		<td><span class='texto_mini '>$coments</span></td>
<td> </td><td> </td>
		 </tr>
		 <tr>
		 <td> </td>
		 </tr>
		
		 <tr>
		<td><font color='blue'>Forma de pago y envío elegida:</font><br><span class='texto_mini '> $pago </span><br>
		$envio_modo</td>
<td> </td><td> </td>
		 </tr>
		</table>
		<br><br><br><br><br> 
		<br><br><br><br><br>
		
		  <table align='left' width='100%'>
		   <tr>
		  <td>  </td>
		  </tr>
		   <tr>
		  <td> </td>
		  </tr>
		   <tr>
		  <td>  </td>
		  </tr>
		   <tr>
		  <td> </td>
		  </tr>
		   <tr>
		  <td>  </td>
		  </tr>
		   <tr>
		  <td>  </td>
		  </tr>
		  <tr>
		  <td> <hr> </td>
		  </tr>
		  <tr>
		 <td ><br>
</td>
		 </tr>
		</table>
		
		
		 <br>

 ";

$datos_vendedor="<br><p> Gloria Botonero<br>
C/ Carreras, 58<br>
41400 Écija (Sevilla)<br>

<p>
Teléfono y Fax + (34) 955904274
Móvil + (34) 615623896 </p><br>
<p>
<b>E-mail</b>: info@gloriabotonero.com<br>
<b>Soporte técnico</b>: soportetecnico@gloriabotonero.com <br>
<b>Web:</b> www.gloriabotonero.com </p><br>
";
?>
