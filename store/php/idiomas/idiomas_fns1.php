<?php
@session_start();
$row=array();
$user['country']=array();

//Cabecera
if (!  ($_SESSION['idioma' ] == 2 ) )

{

	$shop="Tienda";

	$cart="Cesta de la compra ";

	$whom="Quienes somos";

	$how="Como comprar";

	$contact="Contacto";
		
	$url_cart="carrito_php/ver_carrito.php";

		$url_info="info.htm";

	$url_contacto="contacto.php";
	
	$url_quienes="quienes.htm";
	
	
	$promo="Noticias";
    $cost="Precio";
}	

else
{

$shop="Shop";

	$cart="Cart";

	$whom="Whom";

	$how="How to buy";

	$contact="Contact";		

	$url_cart="carrito_php/ver_carrito.php";

	$url_info="info_eng.htm";
	
	$url_contacto="contacto_eng.htm" ;
	
	$url_quienes="quienes_eng.htm";
	
	$promo="Promo";
	
	$cost="Price";


}
//FORMULARIOS

//Variables idiomas en caso de ser espa�ol o cualquiera menos ingl�s 
if (!  ($_SESSION['idioma' ] == 2 ) )
{
$register="REGISTRO DE CLIENTE";
$name="Nombre";
$surname="Apellidos";
$adress="Direcci�n (calle y n�mero)";
$city="Ciudad";
$postal="C�digo Postal";
$state="Provincia";
$country="Pa�s";
$telf="Tel�fono";
$celular="Movil";
$email_repeat="Repetir Email";
$enviar="Realizar compra";
$pay ="Forma de pago";
$transferencia="Transferencia o ingreso. Env�o por agencia de transportes.";
$rembolso ="Contra reembolso por Correos.";
$pass="Contrase�a";
$pass_repeat="Repetir contrase�a";
$enviar="HACER PEDIDO";
$forget_pwd="�Olvid� la contrase�a?";
$register_form=" Registrarse para formalizar la compra";
$texto_ofertas ="Deseo recibir noticias, informaci�n o novedades, relacionadas solo con productos o servicios de 
				www.gloriabotonero.com, pudiendo ser desactivada la opci�n en cualquier momento";

$confirm_mail_pwd_rescue="<br><br><br>Escriba su mail dos veces, se le enviar� en breve un Email con un enlace donde podr� asignar a su cuenta una nueva contrase�a";
$no_more_promo="No deseo recibir m�s ofertas a mi Email";

//Paises

if ($user['country']==1)
$user['country']=Espa�a;
if ($user['country']==2)
$user['country']=Alemania;
if ($user['country']==3)
$user['country']=Suecia;
if ($user['country']==4)
$user['country']=Portugal;
if ($user['country']==5)
$user['country']=Suiza;
if ($user['country']==6)
$user['country']=Francia;
if ($user['country']==7)
$user['country']=Italia;
if ($user['country']==8)
$user['country']=Holanda;
if ($user['country']==4)
$user['country']=Belgica;
if ($user['country']==5)
$user['country']=Andorra;
if ($user['country']==6)
$user['country']=Dinamarca;
if ($user['country']==7)
$user['country']=Grecia;
if ($user['country']==8)
$user['country']=Austria;

}
//En caso de que sea ingl�s
else
{
if ($user['country']==1)
$user['country']=Spain;
if ($user['country']==2)
$user['country']=Germany;
if ($user['country']==3)
$user['country']=Suece;
if ($user['country']==4)
$user['country']=Portugal;
if ($user['country']==5)
$user['country']=Schwitzerland;
if ($user['country']==6)
$user['country']=France;
if ($user['country']==7)
$user['country']=Italy;
if ($user['country']==8)
$user['country']=Holland;
if ($user['country']==4)
$user['country']=Belgic;
if ($user['country']==5)
$user['country']=Andorra;
if ($user['country']==6)
$user['country']=Dinamarca;
if ($user['country']==7)
$user['country']=Grece;
if ($user['country']==8)
$user['country']=Austria;


$register="REGISTER";
$name="Name";
$surname="Surname";
$adress="Adress";
$city="City";
$postal="Postal Code";
$state="State";
$country="Country";
$telf="Telephon";
$celular="Celular";
$email_repeat="Repetit Email";
$enviar="Confirm";
$pay="Pay";
$transferencia="Banc-Transfer";
$rembolso ="Postal";
$pass="Password";
$pass_repeat="Password repeat";
$enviar="Login and continue shoping";
$forget_pwd="Do you forget your password?, please clic here";
$register_form=" Register for continue shopping";
$confirm_mail_pwd_rescue="Please enter two times your Email acount for send to you a link where you can put a new password again";
$no_more_promo="No more Promo Email please";
$texto_ofertas ="INGL�S Deseo recibir noticias, informaci�n o novedades, relacionadas solo con productos o servicios de 
				www.gloriabotonero.com, pudiendo ser desactivada la opci�n en cualquier momento";


}

//TEXTOS
if (!  ($_SESSION['idioma' ] == 2 ) )
{
$wellcome="<br><br><br>Bienvenidos a la tienda del gloria Botonero";
$redirect="<br><br>Ha salido correctamente, <br> en breves segundos ser� redireccionado a la tienda";
$no_articles="<br><br><br><br><br><br><b>Lo sentimos, por el momento no hay art�culos en esta categor�a</b>";

}

else
{
$wellcome="Wellcome to Gloria Botonero's shop";
$redirect="<br><br>You are LogedOf Correctly  <br> ,in seconds you'll redirected to the shoo";
$no_articles="<br><br><br>Sorry at the moment no articles in this categorie";

}

	if ($_SESSION['idioma']==2)
    {	
		
		$title = $row["art_name_eng"];
	    $details= $row["art_details_eng"];
		$comprar="Add to cart";
		
	}
	else
	{	
		$title = $row["art_name"];
		$details= $row["art_details"];
		

	}
	
	 if($_SESSION['idioma']==2)
		{
		$image="Image";
		$article="Item";
		$price="Price";
		$comprar_mas="Buy more";
		$pay="Continue";
		$modif="Change";
		$delete="Delete";
		$units="Units";
		$comprar="Add Cart ";
		$cesta="Cart of shopping";
		$textito_cesta="<b>Bienvenido: aqu� puede:</b> <br><br> � Conocer el estado de su cesta de la compra. <br> � Modificar las cantidades de cada producto. Para
 ello introduzca el n�mero de unidades que desea y
 haga clic en Actualizar.<br>
		
		� Seguir comprando.<br>
		� Seguir el proceso de compra haciendo clic en Continuar.<br><br>";
		
		
		}
	else
		{
		$image="Imagen";
		$article="Art�culo";
		$price="Precio";
		$comprar_mas="Seguir comprando";
		$pay="Continuar";
		$modif="Modificar";
		$delete="Borrar";
		$units="Unidades";
		$comprar="A�adir a Cesta";
		if (!$_SESSION['valid_user'] || ereg("ver_carrito.php",$_SERVER['PHP_SELF']) || $_GET['ref'] )
		{
			$cesta="<strong>CESTA DE LA COMPRA</strong><br><br>";
			$textito_cesta="�Para modificar las cantidades de cada art�culo, introduzca la cantidad deseada y haga clic en 	<b>Actualizar</b>. <br>�Para eliminar un producto haga clic en <b>Borrar</b>. 
			<br>�Si desea a�adir m�s art�culos a su cesta haga clic en <b>Seguir comprando</b>.
<br>�Si ha elegido todos los art�culos que necesita haga clic en <b>Continuar</b>.<br>";
		}
		else
		{
		$cesta="<strong>HOJA DE PEDIDO</strong></br>";
		
		$textito_cesta="
		<p>�Si desea a�adir alg�n art�culo a su compra haga clic en<b> Seguir comprando</b>.</p>
		<p>�Para modificar algunos de sus datos, introduzca la informaci�n correcta y 
			haga clic en <b>Actualizar mis datos</b>.</p>
		<p>�Elija el modo de pago y env�o.</p>
		<p>�Revise sus datos y si son correctos haga clic en <b>Hacer pedido</b>.</p>
		<br> ";
		$revise_datos="Revise sus datos y si son correctos haga clic en hacer pedido";
		
		
		}
	}

//envio pedido

if($_SESSION['idioma']==2)
{

	$ok_message="<div class='message'>Your Order are Ok</div>";
	$error_message="<div class='message'>Your Orden can't process</div>";
	$datos="Your don't writte all dates";
	$no_mail_send="<div class='message'>Your pedido can't recibed at this moment,<br>please tried more later ,thanks<br>
	<a href='javascript:history.back();'>Volver</a></di>";
	
}
else
{
$ok_message="<div class='message' align='center'><br><br><br><br><br><br><br><b>Proceso terminado, su pedido se ha realizado correctamente.</b><br>
				 <br>Recibir&aacute; en su email una respuesta autom&aacute;tica generada por el sistema.<br>
				 
				 <br><br><br><b>Gracias por confiar en nosotros</b>
				 
				 
				 </div>"; 
				 
			/*		  $ok_message="<div class='message' align='center'><br><br><br><br><br><br><br><b>Proceso terminado, provisionalmente por razones de mantenimiento no podemos atender su pedido por la web, por ello le pedimos se ponga en contacto con nosotros por tel�fono , Gracias: <h3>955904274</h3<h3>615623896</h3></b><br>";*/
				  
	$error_message="<center> <div class='message'><br><br><br><br> Su pedido NO se ha podido realizar por un error de la red. Disculpe las molestias. Por favor int�ntelo m�s tarde, gracias.		                    </center> </div>";
	
	$datos="<br><br><br><br><b><center>No ha puesto todos los datos. </b><br><br> Por favor revise si falta alguno.<br><br>";
	
	$no_mail_send="<div class='message'><br><br><br><b>Ha ocurrido un error en la p�gina.</center></b>
	
	
	
	
	<br><br><br><br>No se ha podido atender su pedido por el momento.<br> Por favor int�ntelo m�s tarde o p�ngase en contacto con nosotros, Gracias y disculpe las molestias.<br>
</div>";
	

}
//Paises
if($_SESSION['idioma']==2)
{
 if ($_SESSION['valid_user']['country']==1)
 $country_value="Spain";
if ($_SESSION['valid_user']['country']==2)
 $country_value="Germany";
 if ($_SESSION['valid_user']['country']==3)
 $country_value="Suece";
if ($_SESSION['valid_user']['country']==4)
 $country_value="Portugal";
 if ($_SESSION['valid_user']['country']==5)
 $country_value="Suiz";
if ($_SESSION['valid_user']['country']==6)
 $country_value="France";
 if ($_SESSION['valid_user']['country']==7)
 $country_value="Italy";
 if ($_SESSION['valid_user']['country']==8)
 $country_value="Holland";
 if ($_SESSION['valid_user']['country']==9)
 $country_value="Belgic";
 if ($_SESSION['valid_user']['country']==10)
 $country_value="Andorra";
 if ($_SESSION['valid_user']['country']==11)
 $country_value="Denmarc";
 if ($_SESSION['valid_user']['country']==12)
 $country_value="Grece";
 if ($_SESSION['valid_user']['country']==13)
 $country_value="Austria";
 }
 else
 {
  if ($_SESSION['valid_user']['country']==1)
 $country_value="Espa�a";
if ($_SESSION['valid_user']['country']==2)
 $country_value="Alemania";
 if ($_SESSION['valid_user']['country']==3)
 $country_value="Suecia";
if ($_SESSION['valid_user']['country']==4)
 $country_value="Portugal";
 if ($_SESSION['valid_user']['country']==5)
 $country_value="Suiza";
if ($_SESSION['valid_user']['country']==6)
 $country_value="Francia";
 if ($_SESSION['valid_user']['country']==7)
 $country_value="Italia";
 if ($_SESSION['valid_user']['country']==8)
 $country_value="Holanda";
 if ($_SESSION['valid_user']['country']==9)
 $country_value="Belgica";
 if ($_SESSION['valid_user']['country']==10)
 $country_value="Andorra";
 if ($_SESSION['valid_user']['country']==11)
 $country_value="Dinamarca";
 if ($_SESSION['valid_user']['country']==12)
 $country_value="Grecia";
 if ($_SESSION['valid_user']['country']==13)
 $country_value="Austria";
 
 }
 


 //Textos de cajitas de Login 
 
 if($_SESSION['idioma']==2)
{

 $acceso_cliente="Acces Customer";

}
else
{

 $acceso_cliente="ACCESO CLIENTE";


}
//Mercancias enviadas

$mercancia_enviada='La mercanc�a enviada por Gloria Botonero mediante la agencia Tourline Express est� asegurada. Cualquier rotura o desperfecto causado durante el transporte, deber� ser comunicado a Gloria Botonero en un plazo m�ximo de 24 horas desde la recepci�n del paquete, de lo contrario se entender� que se ha recibido en perfecto estado y no proceder� la reclamaci�n de la misma.<br><br>

La mercanc�a que viaje por otro medio de transporte, ser� responsabilidad del cliente.';

//TEXTOS MAILS  envio pedido , restauraci�n contrase�a etc etc



?>