<?php

//Constants
define('EMAIL_SUPPORT', 'robbyschuh@gmail.com');
define('TIENDA', 'gloriabotonero.com');
define('HOST', 'smtp.sparkpostmail.com');
define('USERNAME', 'SMTP_Injection');
define('SENDERNAME', 'Gloria Botonero');

define('EMAIL', 'postmaster@gloriabotonero.com');
define('EMAILWEBMASTER', 'info@gloriabotonero.com');
define('PWD', 'a0056e3ebe9b56fc197d3927f3447cc6ae6b60d5');
define('PORT', 587);
define('SMTPAUTH', true);
define('LANGUAGE', 'es');
define('DEBUGOUTPUT', 'html');
define('DEBUG', 1);
define('PROTOCOL', 'tls');


//include ('class.phpmailer.php');
require('PHPMailer/PHPMailerAutoload.php');
include('config_inc.php');
///include ('PHPMailer/class.phpmailer.php');
//include ('PHPMailer/class.phpmailer.php');
//Email Robot que se envia al cliente una vez realizado el pedido indic�ndole que se le enviar� brevemente otro mail
//en el que se le dir� los dias que tardar� su pedido as� como los portes
function mail_bienvenida($email,$password) {


$asunto="Bienvenido a la tienda";
$mensaje="
<h4><font color='blue'>Bienvenido a la tienda de Gloria Botonero :</h4></font><br>
<h3>Datos de usuario:</h3>
<p>usuario: ".$email."</p>
<p>contraseña: ".$password."</p";


$mensaje.="<p>".$datos_vendedor."</p>
<p></p>";

//$mail = new phpmailer();
try {
  $mail = new PHPMailer;

  $mail->IsSMTP();

  $mail->Host = HOST;

  $mail->SMTPAuth = SMTPAUTH;

  $mail->Username = USERNAME;

  $mail->Password = PWD;

  $mail->SMTPSecure = PROTOCOL;

  $mail->Port = PORT;

  $mail->From = USERNAME;

  $mail->setFrom(EMAIL, HOST);

  $mail->FromName = SENDERNAME;

  $mail->Subject = $asunto;

  $mail->AltBody = $asunto;

  $mail->Body    = $mensaje;

  $mail->isHTML(true);
  
  //$mail->MsgHTML($mensaje);

  $mail->addAddress($email); //Mail a cliente
  $mail->addAddress(EMAIL_SUPPORT); //Mail a soporte
  $mail->addAddress(EMAILWEBMASTER); //Mail a administrador

  $mail->send();

}

   catch (phpmailerException $e){
     log_admin($e->errorMessage(), 'error','gloriabotonero.com', $email);
    
    } //Pretty error msg from PHPMailer


}

function mail_pedido ($email,$ref,$total,$coments,$forma_pago) {

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
  $asunto="Su Pedido en " .TIENDA;

  $asunto_copia="Copia del pedido";

  $pedido = su_pedido();

  $date = date("j,m,Y");

  $date = str_replace (",", "-",$date);
  $mensaje="
  <h4><font color='blue'>Estimado cliente:</h4></font><br>
  <p>Su pedido se ha enviado correctamente :</p>
  <p>En breve nos pondremos en contacto con Vd. para darle la informaci&oacute;n detallada de su compra.<p>
  <p>No realice ning&uacute;n pago ahora.</p>
  <p>Sus datos son los siguientes:</p>
  <p><b>Pedido n&uacute;mero $ref </b>de fecha ". $date."</p>
  " .$pedido. "<table align='left' width='100%'>
  		<tr> <th align='right' colspan='3'>Total: $total &euro;</th></tr>
  		<tr>
  		<td><font color='blue'>Sus Comentarios:<br></font></td>
  		<td> </td><td> </td>
  		 </tr>
  		<tr>
  		<td><span class='texto_mini '>" .$coments. "</span></td>
  <td> </td><td> </td>
  		 </tr>
  		 <tr>
  		 <td> </td>
  		 </tr>

  		 <tr>
  		<td><font color='blue'>Forma de pago y envío elegida:</font><br><span class='texto_mini '>" .$pago. "</span><br>
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

  try {
    $mail = new PHPMailer;

    $mail->IsSMTP();

    $mail->Host = HOST;

    $mail->SMTPAuth = SMTPAUTH;

    $mail->Username = USERNAME;

    $mail->Password = PWD;

    $mail->SMTPSecure = PROTOCOL;

    $mail->Port = PORT;

    $mail->From = USERNAME;

    $mail->setFrom(EMAIL, HOST);

    $mail->FromName = SENDERNAME;

    $mail->Subject = $asunto;

    $mail->AltBody = $asunto;

    $mail->Body    = $mensaje;

    $mail->isHTML(true);
    
    //$mail->MsgHTML($mensaje);

    $mail->addAddress($email); //Mail a cliente
    $mail->addAddress(EMAIL_SUPPORT); //Mail a soporte
    $mail->addAddress(EMAILWEBMASTER); //Mail a administrador

    if ($mail->send()){
      return TRUE;
    }
  }

    catch (phpmailerException $e){
     //  log_admin($e->errorMessage(), 'error','gloriabotonero.com', $email);
       return $e->errorMessage(); 
      
      } //P
  // Intentamos enviarlo por SMTP
  /*
  if(!$mail->send()) {

    log_admin('SMTP pedido error!', 'error','gloriabotonero.com', $email);
    // Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
    $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
    $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

    $cabeceras .= 'To: ' .$email. ' <'.$email.'>' . "\r\n";
    $cabeceras .= 'From: '.SENDERNAME.' <' .EMAIL. '>' . "\r\n";


    // Si falla el SMTP intentamos enviarlo por mail().
    if(!mail($email, $asunto, $mensaje, $cabeceras) ){
      log_admin('SMTP pedido error! (email function)','error', 'gloriabotonero.com',$email);
      return FALSE;
    }

    return TRUE;
  } 

    return TRUE;
  */
}

function log_admin($sent_result, $type = 'error', $site, $sent_to_user) {
 
  $mensaje = $sent_result;
  $asunto = ' FROM: '.$site.' SENT TO '.$sent_to_user;
  
  $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
  $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

  $cabeceras .= 'To: Support <EMAIL_SUPPORT>' . "\r\n";
  $cabeceras .= 'From: Recordatorio <avisos@gloriabotonero.com>' . "\r\n";
  

  if (!empty($sent_result)){
    if(!mail(EMAIL_SUPPORT, $type.' '.$asunto, $mensaje, $cabeceras)){
              $mail = new PHPMailer;

              $mail->IsSMTP();

              $mail->Host = HOST;

              $mail->SMTPAuth = SMTPAUTH;

              $mail->Username = USERNAME;

              $mail->Password = PWD;

              $mail->SMTPSecure = PROTOCOL;

              $mail->Port = PORT;

              $mail->From = USERNAME;

              $mail->setFrom(EMAIL, HOST);

              $mail->FromName = SENDERNAME;

              $mail->Subject = $asunto;

              $mail->AltBody = $asunto;

              $mail->Body    = $mensaje;

              $mail->isHTML(true);
              
              //$mail->MsgHTML($mensaje);

              $mail->addAddress($email); //Mail a cliente
              $mail->addAddress(EMAIL_SUPPORT); //Mail a soporte
              $mail->addAddress(EMAILWEBMASTER); //Mail a administrador

              $remitente="From:" .SENDERNAME. "  \n \r\nContent-type: text/html\r\n";
            // Intentamos enviarlo por SMTP
            if(!$mail->send()) {

              log_admin('SMTP not works', 'error',HOST, $_POST["email"]);
              // Para enviar un correo HTML mail, la cabecera Content-type debe fijarse
              $cabeceras  = 'MIME-Version: 1.0' . "\r\n";
              $cabeceras .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

              $cabeceras .= 'To: ' .$email. ' <'.$email.'>' . "\r\n";
              $cabeceras .= 'From: Recordatorio <' .EMAIL. '>' . "\r\n";

            }
    }
  }

}

//Envio de publicidad a todos los clientes que as� lo desean
function masive_mail_form() {
?>
<form action="<?php echo $PHP_SELF; ?>" method="post">
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
<form action="<?php  echo $_SERVER['PHP_SELF']; ?>" method="post">
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

//Mail de confirmaci�n de los días de tardanza del pedido
function mail_confirm ($texto,$email,$asunto,$ref,$envio) {

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

    $mensaje.= $texto;
    $mensaje.="</br>" . $pedido . "<br>";
    $mensaje.="<br>" . $cliente . "<br>";
}
else {
    $mensaje="<br><br><br><br><br><br>" .$texto. "<br><br><br><br><br><br><br><br><br><br>";
}
$mensaje.= $datos_vendedor;

// Para enviar un correo HTML, debe establecerse la cabecera Content-type
$cabeceras  = 'MIME-Version: 1.0' . "\r\n";
$cabeceras .= 'Content-type: text/html; charset=charset=UTF-8' . "\r\n";
$cabeceras .= 'To: ' . $email .' < ' . $email  . ">\r\n";


//$cabeceras .= 'To: ' . $email .' < ' . $email . '>, tienda <gloriabotonero@gmail.com>' . "\r\n";
$cabeceras .= 'From: '.SENDERNAME.' <' .EMAIL. '>' . "\r\n";
$cabeceras .= 'Cc: gloriabotonero@gmail.com' . "\r\n";
$cabeceras .= 'Bcc: rob@masquebits.com' . "\r\n";

 //indicamos el inicio de nuestro lcodigo php

 $mail = new PHPMailer;

  $mail->IsSMTP();

  $mail->Host = HOST;

  $mail->SMTPAuth = SMTPAUTH;

  $mail->Username = USERNAME;

  $mail->Password = PWD;

  $mail->SMTPSecure = PROTOCOL;

  $mail->Port = PORT;

  $mail->From = USERNAME;

  $mail->setFrom(EMAIL, HOST);

  $mail->FromName = SENDERNAME;

  $mail->Subject = $asunto;

  $mail->AltBody = $asunto;

  $mail->Body    = $mensaje;

  $mail->isHTML(true);
  
  //$mail->MsgHTML($mensaje);

  $mail->addAddress($email); //Mail a cliente
  $mail->addAddress(EMAIL_SUPPORT); //Mail a soporte
  $mail->addAddress(EMAILWEBMASTER); //Mail a administrador

$remitente = "From: " .SENDERNAME ." ".EMAIL. "  \n \r\nContent-type: text/html\r\n";
    try 
        {
        $mail->send();

       }
       catch (Exception $e) {
        echo '<p>En estos momentos estamos solucionando un problema con el correo, '
           . 'por favor inténtelo más tarde, gracias: ',  $e->getMessage(), "</p>"; 
        return FALSE;
    }

}
function restore_pwd ($email)  {

  $mail_webmaster="info@gloriabotonero.com";
  $url="http://www.gloriabotonero.com";

  // To send HTML mail, the Content-type header must be set
  $headers  = 'MIME-Version: 1.0' . "\r\n";
  $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
  $headers .= 'From: Tienda de artesanía Gloria Botonero <gloriabotonero@masquebits.com>' . "\r\n";

  $sendto = trim($email);
  if ($asunto == NULL ){
      $asunto = "Recupera la contraseña ";
  }
  //c�digo md5 del email para restaurar contrase�a , es el c�digo de la petici�n de cambio de pwd
  if (!pet( trim( md5($email) ) ) ) {
      return FALSE;
  }

  //Si insertamos el c�digo de la petici�n entonces enviamos el mail
  //Mensaje Contrarembolso

  //$sender="From: gloriabotonero@gloriabotonero.com \r\nContent-type: text/html\r\n";
  $mensaje="<br/>
  <b>".$tienda_name."</b>
  <br><br>
  Mail autom&aacute;tico para recuperar contrase&ntilde;a

  <p>Si no tiene habilitado en su configuraci&oacute;n de su cliente de correo electr&oacute;nico el poder recibir los Email en HTML, no podr&aacute; ver correctamente este mensaje</p>
  <br><br>

  abajo ver&aacute; un enlace, por favor p&iacute;nchelo y en la p&aacute;gina que se le abre
  escriba una nueva contrase&ntilde;a.

  <br><br><br>Si al hacer clic en el enlace no se le abriera ninguna p&aacute;gina, entonces copie esta direcci&oacute;n y p&eacute;gela en su navegador. <br><br>
  Gracias y saludos <br/><br/><br/> ".$url."/tienda_gloria/php/admin/nuevo_pwd.php?coddeerrttyasd=".md5(trim($email))."&email=$email ";


  $mensaje.=$datos_vendedor;

   $mail = new PHPMailer;

    $mail->IsSMTP();

    $mail->Host = HOST;

    $mail->SMTPAuth = SMTPAUTH;

    $mail->Username = USERNAME;

    $mail->Password = PWD;

    $mail->SMTPSecure = PROTOCOL;

    $mail->Port = PORT;

    $mail->From = USERNAME;

    $mail->setFrom(EMAIL, HOST);

    $mail->FromName = SENDERNAME;

    $mail->Subject = utf8_decode($asunto);

    $mail->AltBody = $asunto;

    $mail->Body    = $mensaje;

    $mail->isHTML(true);
    
    //$mail->MsgHTML($mensaje);

    $mail->addAddress($email); //Mail a cliente
    $mail->addAddress(EMAIL_SUPPORT); //Mail a administrador


      try 
          {
          $mail->send();

         }
         catch (Exception $e) {
          echo '<p>En estos momentos estamos solucionando un problema con el correo, '
             . 'por favor inténtelo más tarde, gracias: ',  $e->getMessage(), "</p>"; 
          return FALSE;
      }
          $mail->ClearAddresses();
          $mail->ClearAttachments();
          return TRUE;  
}