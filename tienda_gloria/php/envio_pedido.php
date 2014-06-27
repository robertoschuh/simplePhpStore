<?php
require_once ("admin/admin_fns.php");
require_once ("admin/pedidos_fns.php");
require_once("../carrito_php/lib_carrito.php");
require_once ("mails/mails_fns.php");
require_once ("almacen_fns.php");
require_once ("admin/biblioteca_vars.php");
include ("idiomas/idiomas_fns.php");
include ("db_fns.php");
include ("data_valid_fns.php");

$conn = db_connect();


$nombre=$_SESSION["ocarrito"]->array_name;
$precio=$_SESSION["ocarrito"]->array_price_total;
$num=$_SESSION["ocarrito"]->num_productos;
$id=$_SESSION["ocarrito"]->array_id_art;
$total=$_POST['total'];

//pasamos el pais a min�usculas
$country=strtolower($_POST["country"]);
//Actualizamos los datos de la Bd por si el cliente los ha cambiado si le hemos dado actualizar mis datos 
if ($_POST['Actualizar'] && !$_POST['Aceptar'] )
{
//comprobamos que es un mail v�lido antes de actualizar
	
if (!valid_email($_POST["email"]))
	{
	echo "<center>El Email no es válido, por favor inténtelo de nuevo, Gracias <br>";
	echo " <br><br><a href='javascript:history.back(-1)'  class='boton'>Volver</a><center><br>";
	
	echo exit;
	
	}
	//comprobamos que es un pass v�lido
if (pais_value($country)<0 || pais_value($country) >13)	
{
	echo "<center>Compruebe que ha escrito bien el país, Gracias <br>";

	echo "<br><br> <a href='javascript:history.back(-1)'  class='boton'>Volver</a><center><br>";

	echo exit;
	
	}

$result=update_datos_clientes($_POST['name'],$_POST['surname'],$_POST["address"],$_POST["city"],$_POST["state"],$_POST["zip"],$country,
						$_POST["telf"],$_POST["celular"],$_POST["email"],$_POST["email2"]);
if (!$result)
echo "Sus datos no se han  podido actualizar por el momento , por favor inténtelo más tarde,este sistema esta en obras momentaneamente Gracias<br> resultado: $result";
	else

	echo "<p><h2>Actualización de sus datos correcta<br></h2></p>
		 <p>Recuerde que para que se reconozcan los cambios en sus próximas compras deberá volver a iniciar sesión en la tienda.<br>
		 De lo contrario la actualización será válida solo para esta compra.</p>";
	echo " <p ><a href='javascript:history.back();' class='anadir_cesta'>Volver</a></p>";
	
	
exit;
	
}

//if ($name==NULL || address==NULL || city==NULL || state==NULL || zip==NULL || country==NULL || email==NULL)

$url=$_SERVER['HTTP_REFERER'];
//Comrpobamos que el cliente escribe todos los datos necesarios para que se le envie el pedido 

if (!$_POST["name"] || !$_POST["surname"] || !$_POST["address"]|| !$_POST["city"]|| !$_POST["state"]
	|| !$_POST["zip"]|| !$_POST["country"]|| !$_POST["email"]|| ( !$_POST["telf"]  &&  !$_POST["celular"]  ) )

	echo "<div class='message'>$datos<br> <a href='javascript:history.back();'>Volver</a></div>";

else
{
/*---recordatorio
$destino: es la direcci�n a donde se enviar� el mensaje

$asunto: es el asunto del mensaje

$mensaje: es el mensaje en s�

$encabezados: aqu� se anexa por ejemplo quien env�a el
*/
//include ("../carrito_php/lib_carrito_respaldo.php");
if ($total<1)
{
echo "<center><h3>Usted no ha selecionado ningún artículo</h3></center>";
echo "<p> Por favor <a href='javascript:history.back();' class='boton'>vuelva</a> y selecione algún artículo , gracias</p>";
exit;
}	

$ref_pedido=get_ref($_REQUEST['name'],$_REQUEST['surname'],$_REQUEST['address'],$_REQUEST['city'],$_REQUEST['state']
					,$_REQUEST['zip'], $_REQUEST['country'],$_REQUEST['email'],$total,$_REQUEST['telf'],
					$_REQUEST['celular'],$_REQUEST['payment']) ;
					


$pedido=su_pedido ();


//$_REQUEST me sirve para recibir tanto por url como por post 

$asunto="Pedido Nuevo";
$mensaje="\nEnvio Pedido\n <br><span class='text_mails'>Nombre</span> : 
		  ". utf8_encode($_REQUEST['name'])."<br>Dirección:  ". utf8_encode($_REQUEST['address'])."
		  <br>Ciudad: ".$_REQUEST['city']."
		  <br>Estado:  ".$_REQUEST['state']."
		  <br> zip:  ". $_REQUEST['zip'] ."<br><span class='text_mails'>
		  Pa&iacute;s</span>:  ".$_REQUEST['country']."<br> 
		  <span class='text_mails'>Teléfono</span>:  ".$_REQUEST['telf'] ."<br> 
		  <span class='text_mails'>Movil</span>:  ".$_REQUEST['celular']. 
	"<br><span class='text_mails'>Email</span>:  ".$_REQUEST['email']."<br>
	     <span class='text_mails'> Referencia</span>:   ".$ref_pedido['ref']."<br/>
	     <br/><span class='text_mails'>Comentarios</span>:\n ".$_REQUEST['coments']." <br> 
		 <span class='text_mails'>Porfavor visite este enlace ,identif&iacute;quese e inserte el 
		 n&uacute;mero de Referencia para poder ver los datos del pedido</span>
		  <span class=''>
<a href='$web/tienda_gloria/php/admin/panel/acces.php'>Pinche aqu&iacute;</a><br/>
(si el enlace no funciona por favor copie y pegue la siguiente direcci&oacute;n en el navegador)<br/>
http://www.gloriabotonero.com/tienda_gloria/php/admin/panel/acces.php
			</span>"; 
			
$mail_webmaster = "gloriabotonero@gmail.com";
//correo de control técnico
$mail_webmaster2 = "proyectos@weblineinformatica.com";

$remitente = "From: info@gloriabotonero.com  \n \r\nContent-type: text/html\r\n";



 //Envio del mail a la administradora
if (!mail($mail_webmaster, $asunto, $mensaje,$remitente) )
{
	//mensaje de no se ha podido enviar el mail de confirmaci�n
	echo $no_mail_send;
	exit;
}
//Si se ha enviado correctamente el mail al administrador entonces ..
else 
	{
	mail($mail_webmaster2, $asunto, $mensaje,$remitente);
	
		$i=0;
		
		
		for ($i=0;$i<$num;$i++)
		{
			
			if(!$id[$i]==0) //no aseguramos que no haya sido eliminado previamente
			
			$resultado=pedido_add($id[$i],$ref_pedido['ref'],$nombre[$i],$precio[$i]);
			

		}
		
	
		if (!$resultado)
		{
		//mensaje de no se ha podido a�adir a la bd ,pero para el cliente es el mismo mensaje
		echo $no_mail_send."<br><br><br>";
		?>
			<center <a href='javascript:history.back();' class='boton'>Volver</a></center>
		<?php
		}
		else
		{
		if ($resultado)
				$envio_cliente=mail_pedido( $_POST['email'] , $ref_pedido['ref'] ,$_POST['total'],
											$_POST['coments'],$_POST['payment']);
				
		if ($resultado && $envio_cliente)		
			{
				echo utf8_encode($ok_message);
				
				//Borramos toda la informacion de las cantidades de los articulos
				
				//$borrado=$_SESSION["ocarrito"]->borrar_qty ();
				
			 
			//Desregistramos la variable de sesi�n que contiene la cesta de la compra
			
			//session_unregister("ocarrito") ;
			unset ($_SESSION["ocarrito"] );
			//session_destroy();
			
			}
		else	
		echo $error_message;

		
				
				
		
		}}}
