<style type="text/css">

.msg{background-color:#EAEAFF; color:#1E1E1E ; text-align:center; width:50%; margin:auto}
</style>
<?php
include ("data_valid_fns.php");
include ("fns.php");
$name=$_POST['name'];
$surname=$_POST['surname'];
$adress=$_POST['adress'];
$city=$_POST['city'];
$country=$_POST['country'];
$email=$_POST['email'];
$password=md5($_POST['password']);
$state=$_POST['state'];
$telf=$_POST['telf'];
$celular=$_POST['celular'];
$zip=$_POST['zip'];
$promo=$_POST['promo'];

function volver_atras() { 
?>
  <div style="text-align:center">
    <form name="volver" action="../php/register.php?apagar=26.6517" method="post" >
     <input name="name" type="hidden"   value="<?php echo $_POST['name'];?>"/>
	
	<input name="surname" type="hidden"   value="<?php echo $_POST['surname'];?>"/>
    <input name="adress" type="hidden"   value="<?php echo $_POST['adress'];?>"/>
    <input name="city" type="hidden"   value="<?php echo $_POST['city'];?>"/>
     <input name="state" type="hidden"   value="<?php echo $_POST['state'];?>"/>
    <input name="email" type="hidden"   value="<?php echo $_POST['email'];?>"/>
    <input name="telf" type="hidden"   value="<?php echo $_POST['telf'];?>"/>
    <input name="zip" type="hidden"   value="<?php echo $_POST['zip'];?>"/>
        <input name="celular" type="hidden"   value="<?php echo $_POST['celular'];?>"/>
        <input name="apagar" type="hidden" value="<?php echo $_POST['apagar'];?>" />
        <input type="submit" name="Volver" value="volver"  />
</form>
</div>
<?php
}
if (!$_POST["name"] || !$_POST["surname"] || !$_POST["adress"] 
	|| !$_POST["city"] || !$_POST["country"] || !$_POST["email"] ||
	  !$_POST["password"]  || !$_POST["password2"] 
	 || !$_POST["zip"] || !$_POST['telf'] && !$_POST['celular']   )
	{
	echo "<div style='text-align:center' class='msg'>No ha rellenado todos los campos obligatorios, por favor vuelva atr&aacute;s Gracias.<br/>";
	 volver_atras();
	echo exit;
	
	}	
	
if (!valid_email($email))
	{
	echo "<div style='text-align:center' class='msg'>El <strong>Email no es válido</strong>, por favor int&eacute;ntelo de nuevo, Gracias </div>";

    volver_atras();
	
	echo exit;
	
	}
	
if ( $_POST['password']  !== $_POST['password2']) 
	{
		echo "<div style='text-align:center' class='msg'><strong>Las Contrase&ntilde;as no coinciden</strong> , por favor vuelva atr&aacute;s e int&eacute;ntelo de nuevo, Gracias</div> ";
	 volver_atras();
		exit;
	}
	
	if (strlen ($_POST['password']) > 10   )
	  {	
		echo "<div style='text-align:center' class='msg'>
		Las contrase&ntilde;as son <strong>demasiado largas</strong> (m&aacute;ximo 10 caracteres por favor)</div>";
			 volver_atras();
				//echo strlen ($_POST['password'] )  ;

			exit;

		}
	if (strlen ($_POST['password']) < 6   )
	  {	
		echo "<div style='text-align:center' class='msg'>
		Las contrase&ntilde;as son <strong>demasiado cortas</strong> (m&iacute;nimo 6 caracteres por favor)</div>";
			 volver_atras();
				//echo strlen ($_POST['password'] )  ;

			exit;

		}	
else
{	
	
 $conn = db_connect();
 
 
 $query ="insert into usuarios values
 		 ('$email','$password','$name','$surname','$adress','$city','$zip',
		 '$state','$country','$telf','$celular','$promo' ) 
		";
		
		$result=mysql_query($query);
		if (!$result) {
		echo "<div style='text-align:center' class='msg'><strong>Este Email se encuentra ya registrado</strong>, si usted está ya registrado y no consigue entrar, por favor vuelva atr&aacute;s y pinche en el bot&oacute;n de <strong>recuperar contrase&ntilde;a</strong> , gracias</div>";
		//or die (mysql_error());
		volver_atras();

		}

else
{
	echo "<div style='text-align:center' class='msg'>Su registro se ha llevado a cabo correctamente, Gracias <p> Introduzca su Email y su Contraseña para poder entrar como usuario registrado</div>";
	echo "<br>";
	//$mail_webmaster="info@gloriabotonero.com";
$mail_webmaster="proyectos@weblineinformatica.com";
	$mail_webmaster2="robbyschuh@gmail.com";
	$asunto="nuevo registro de usuario";
	$remitente="From: registro@gloriabotonero.com  \n \r\nContent-type: text/html\r\n";
	$mensaje="Email: ".$_POST["email"]."<br/> Nombre: ".$_POST["name"]."<br/> Appelidos: ".$_POST["name"]."<br/>
	Ciudad: ".$_POST["city"]."<br/>Fijo: ".$_POST['telf']." <br/>Movil: ".$_POST['celular'] ;
	if (mail($mail_webmaster, $asunto, $mensaje,$remitente)) {
		mail($mail_webmaster2, $asunto, $mensaje,$remitente);
	  	 $msg_user="<p>Bienvenido a la tienda de Gloria Botonero</p>";
		 $msg_user.="<p>Ya puede realizar compras utilizando sus datos de usuario</p>";
		 $msg_user.="<p>Usuario: <strong>".$_POST["email"]."</strong></p>";
		 $msg_user.="<p>Contrase&ntilde;a: <strong>".$_POST["password"]."</strong></p>";
		 $msg_user.="<p>Gracias</p><p> Gloria Botonero</p>";
		 mail($_POST["email"], "Felicidades registro completado", $msg_user,$remitente);
	
	}
	login_box_user($_POST['apagar']);
	
}
}
?>
