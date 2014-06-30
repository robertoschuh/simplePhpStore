<?php

//Constants
define('EMAIL_SUPPORT', 'rob@masquebits.com');

//Email Robot que se envia al cliente una vez realizado el pedido indic�ndole que se le enviar� brevemente otro mail
//en el que se le dir� los dias que tardar� su pedido as� como los portes
function mail_bienvenida($email,$password) {
include("php/config_inc.php");

$asunto="Bienvenido a la tienda";
$mensaje="
<h4><font color='blue'>Bienvenido a la tienda de Gloria Botonero :</h4></font><br>
<h3>Datos de usuario:</h3>
<p>usuario: ".$email."</p>
<p>contraseña: ".$password."</p";


$mensaje.="<p>".$datos_vendedor."</p>
<p></p>";

if (!mail($email, $asunto, $mensaje,$remitente) )
return false;
return true;

}
function mail_pedido ($email,$ref,$total,$coments,$forma_pago) {
//datos de config de los correos
include("config_inc.php");
//llamamos a las clases phpmailer
require('class.phpmailer.php');
require('class.smtp.php');

if ($forma_pago==1)
{
$pago="Transferencia o ingreso bancario";
$envio_modo="y env&iacute;o por Tourline Express";
}
else
{
$pago="Contrarembolso";
$envio_modo="Correos";
}
$asunto="Su Pedido en ".$tienda_name;

$asunto_copia="Copia del pedido";

$pedido=su_pedido ();

$date=date("j,m,Y");

$date = str_replace (",", "-",$date);
$mensaje="
<h4><font color='blue'>Estimado cliente:</h4></font><br>
<p>Su pedido se ha enviado correctamente :</p>
<p>En breve nos pondremos en contacto con Vd. para darle la informaci&oacute;n detallada de su compra.<p>
<p>No realice ning&uacute;n pago ahora.</p>
<p>Sus datos son los siguientes:</p>
<p><b>Pedido n&uacute;mero $ref </b>de fecha ". $date."</p>
$pedido <table align='left' width='100%'>
		<tr> <th align='right' colspan='3'>Total: $total &euro;</th></tr>
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

$mensaje.=$datos_vendedor;

$mail = new phpmailer();
$mail->IsSMTP();

$mail->Host = "gloriabotonero.com";

$mail->From = 'avisos@gloriabotonero.com';

$mail->FromName = 'Gloria Botonero';

$mail->Subject = $asunto;

$mail->AltBody = $asunto;

$mail->MsgHTML($mensaje);

$mail->AddAddress($email); //Mail a cliente
$mail->AddAddress($mail_webmaster); //Mail a administrador

$mail->SMTPAuth = true;

$mail->Username = 'avisos@gloriabotonero.com';

$mail->Password = 'Energia54321';



// Intentamos enviarlo por SMTP
if(!$mail->Send()) {

  log_admin('SMTP not works', 'error','gloriabotonero.com', $email);
  // Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
  $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
  $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  $cabeceras .= 'To: Mary <'.$email.'>' . "\r\n";
  $cabeceras .= 'From: Recordatorio <avisos@gloriabotonero.com>' . "\r\n";


  if (!mail($email, $asunto, $mensaje, $cabeceras)){
    return false;
  }
  // Si falla el SMTP intentamos enviarlo por mail().
  if(!mail($email, $asunto, $mensaje, $cabeceras) ){
    log_admin('EMAIL function not works','error', 'gloriabotonero.com',$email);
    return FALSE;
  }

  return TRUE;
}
else {
  return TRUE;
}
 //indicamos el inicio de nuestro lcodigo php
/*if ( mail($email, $asunto, $mensaje,$headers) ) {
		//enviamos copia a webmaster
		mail($mail_webmaster,$asunto_copia, $mensaje,$headers) ;

return true;

}
else
return false;
*/

}

function log_admin($sent_result, $type = 'error', $site, $sent_to_user) {

  $mensaje = $sent_result;

  $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
  $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  $cabeceras .= 'To: Support <EMAIL_SUPPORT>' . "\r\n";
  $cabeceras .= 'From: Recordatorio <avisos@gloriabotonero.com>' . "\r\n";


  if (!empty($sent_result)){
    mail(EMAIL_SUPPORT, $type.' FROM: '.$site.' SENT TO '.$sent_to_user, $mensaje, $cabeceras);
  }

}

//Envio de publicidad a todos los clientes que as� lo desean
function masive_mail_form() {

?>
<form action="<?=$PHP_SELF ?>" method="post">
<table width="200" border="0" align="center">
  <tr>
    <th colspan='3'>Envio Mails a clientes</th>

  </tr>
  <tr>
    <td> Asunto: </td><td><input name="asunto" type="text" /></td>
   </tr>
   <tr>
	<td>Mensaje</td>
    <td><textarea name="mensaje" cols="40" rows="16"></textarea>
</td><td></td>
  </tr>
  <tr>
    <td colspan='3' align="center"><input type="submit" name="Submit" value="Enviar" /></td>

  </tr>
</table>

</form>

<?php
}
function consulta_mails_promo () {

 $conn = db_connect();
  if (!$conn)
    return 0;

  // Selecciona los mails de los usuarios solo que han escojido recibir publicidad en su correo
  $result = mysql_query("select email,name from usuarios
                         where promo=1 ");
  if (!$result)

	return 0;

  if (mysql_num_rows($result)>0)

		$datos=db_result_to_array($result);

	return $datos;
}

function masive_mail($tema,$mensaje ) {
//datos de config de los correos
include("php/config_inc.php");

//include("../biblioteca_vars.php");

$contador=0;
$datos=consulta_mails_promo ();

$asunto="Información de ".$tienda_name.": ".$tema;

$mensaje.="<br><br><br><br>".$tienda_name."<br>".$datos_vendedor."<br><br>".$estimado_cliente."";

//Mensaje Contrarembolso

foreach ($datos as $row)
	{

 //indicamos el inicio de nuestro lcodigo php
if ( mail($row['email'], $asunto, $mensaje,$remitente) );
//Cada vez que un mail se envia bien a un usuario el contador aumenta en 1
$contador++;
	}//fin del foreach
if ($contador<=0)
return 0;
else
return $contador;
}
function mail_confirm_form($email,$ref,$portes) {
?>
<form action="<?  echo $_SERVER['PHP_SELF'] ?>" method="post">
<table width="200" border="0" align="center">
  <tr>
    <th colspan='3'>Envio Mails a clientes</th>

  </tr>
  <tr>
  <td align="left"> Asunto: </td><td align="left"><input name="asunto" type="text" size="55" /></td>
   </tr>
   <tr>
	<td align="left" colspan="2">Mensaje</td>
	</tr>
	<tr>
    <td colspan="2"><textarea name="mensaje" cols="65" rows="20" class="message_email"></textarea></td>
  </tr>

  <tr>
    <td colspan='3' align="center"><input type="submit" name="Submit" value="Enviar" /></td>

  </tr>
</table>
<input name="email" type="hidden" value="<? echo $email ?>" />
<input name="ref" type="hidden" value="<? echo $ref ?>" />
<input name="portes" type="hidden" value="<? echo $portes ?>" />
</form>
<?php
}
//Mail de confirmaci�n de los d�as de tardanza del pedido
function mail_confirm ($texto,$email,$asunto,$ref,$envio) {
//datos de config de los correos
include("../config_inc.php");;

$pedido = pedido($ref,$envio);

$cliente = datos_cliente($ref);


//fecha actual

$date=date("j,m,Y");

$date = str_replace (",", "-",$date);

if ($asunto==NULL )
$asunto = "Confirmación disponibilidad pedido ".$tienda_name;

$buscar = "NO HAY EXISTENCIAS";

if ( !ereg($buscar,$asunto) )
{
    $mensaje="<h4><font color='blue'>Estimado cliente:</h4></font><br>
    A continuación le facilitamos los detalles de la compra que ha realizado en nuestra página web:</p>
    <b>Pedido número: ". $ref."</b> con fecha: ". $date ."</p>
    <br>";

    $mensaje.= "$texto";
    $mensaje.="</br>" . $pedido . "<br>";
    $mensaje.="<br>" . $cliente . "<br>";
}
else {
    $mensaje="<br><br><br><br><br><br>".$texto."<br><br><br><br><br><br><br><br><br><br>";
}
$mensaje.= $datos_vendedor;

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=charset=UTF-8' . "\r\n";
$cabeceras .= 'To: ' . $email .' < ' . $email  . ">\r\n";


//$cabeceras .= 'To: ' . $email .' < ' . $email . '>, tienda <gloriabotonero@gmail.com>' . "\r\n";
$cabeceras .= 'From: Recordatorio <info@gloriabotonero.com>' . "\r\n";
$cabeceras .= 'Cc: gloriabotonero@gmail.com' . "\r\n";
$cabeceras .= 'Bcc: robbyschuh@gmail.com' . "\r\n";

 //indicamos el inicio de nuestro lcodigo php

if ( mail($to, '=?UTF-8?B?'.base64_encode($asunto).'?=', $mensaje, $cabeceras) ){
    return true;
}
else {
    return false;
}

}
function restore_pwd ($email)  {

//llamamos a las clases phpmailer
require('class.phpmailer.php');
require('class.smtp.php');

$mail_webmaster="info@gloriabotonero.com";
$url="http://www.gloriabotonero.com";

// To send HTML mail, the Content-type header must be set
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
$headers .= 'From: Tienda de artesanía Gloria Botonero <'.$mail_webmaster.'>' . "\r\n";

$sendto=trim($email);
if ($asunto==NULL )
$asunto="Restauración de contraseña ". $tienda_name;

//c�digo md5 del email para restaurar contrase�a , es el c�digo de la petici�n de cambio de pwd
if (!pet( trim( md5($email) ) ) )
return 0;

//Si insertamos el c�digo de la petici�n entonces enviamos el mail
//Mensaje Contrarembolso

//$sender="From: gloriabotonero@gloriabotonero.com \r\nContent-type: text/html\r\n";
$mensaje="<br/>
<b>".$tienda_name."</b>
<br><br>
Mail automático para recuperar contraseña

<p>Si no tiene habilitado en su configuración de su cliente de correo electrónico el poder recibir los Email en HTML, no podrá ver correctamente este mensaje</p>
<br><br>

abajo verá un enlace, por favor pínchelo y en la página que se le abre
escriba una nueva contraseña.

<br><br><br>Si al hacer clic en el enlace no se le abriera ninguna página, entonces copie esta dirección y pégela en su navegador. <br><br>
Gracias y saludos <br/><br/><br/> ".$url."/tienda_gloria/php/admin/nuevo_pwd.php?coddeerrttyasd=".md5(trim($email))."&email=$email ";


$mensaje.=$datos_vendedor;

$mail = new phpmailer();
$mail->IsSMTP();
//$mail->Host = 'gloriabotonero.com';
$mail->Host     = "gloriabotonero.com";

$mail->From = 'info@gloriabotonero.com';

$mail->FromName = 'gloriabotonero.com';

$mail->Subject = utf8_decode($asunto);

$mail->AltBody = $asunto;

$mail->MsgHTML($mensaje);

$mail->AddAddress($email);

$mail->SMTPAuth = true;

$mail->Username = 'info@gloriabotonero.com';

$mail->Password = '54321energia12345';

$remitente="From: info@gloriabotonero.com  \n \r\nContent-type: text/html\r\n";

if(/* !$mail->Send() */ !mail($sendto, $asunto, $mensaje, $remitente)) {
    return false;
} else {
    return true;
}

}