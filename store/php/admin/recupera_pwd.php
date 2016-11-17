<?php
//datos de config de los correos
include("../config_inc.php");

require_once("../fns.php");
require_once("admin_fns.php");

if ($_POST) {
if ( $_POST['email']==$_POST['email2'] && isset($_POST['restore']) )
	{
	//Antes de nada comprobamos que el usuario esta registrado en nuestra Bd
	if (!email_exists ($_POST['email']) )
	{
		echo "<br/><br/>Usted no est registrado.";
	restore_pwd_form();
	exit;
	} 
		//Enviamos un mail con un enlace para cambiar su Pwd
		if ( restore_pwd ($_POST['email']) )
		{
			echo "<br/><br/>Hemos enviado un <b>email</b> con <b>instrucciones</b>
			 para conseguir una <b>nueva contrase&ntilde;a</b>, Gracias.<br/>";
			echo" <p><strong>!!Atenci&oacute;n &#033;&#033;</strong>, es posible que su <b>cliente de correo</b> haya archivado este correo como <b>SPAM o CORREO NO DESEADO</b>,</p><p>por ello le rogamos que si no encuentra el mensaje de restauraci&oacute;n de contrase&ntilde;a mire en esas carpetas</b></p>"; 
			exit;
		}	
		else
		echo "<br/><br/>No se ha podido llevar a cabo su gesti&oacute;n ,por favor int&eacute;ntelo m&aacute;s tarde, Gracias.<br/>";
	
	}
	
if ( $_POST['email']!=$_POST['email2'] )

	echo "<br/><br/>Los Emails no coinciden , por favor int&eacute;ntelo de nuevo , Gracias. <br/>";
}	

//S� pinchamos en cambiar mail
if (isset($_GET['change_mail']) )  {
if ( $_GET['change_mail']==1 )
{
	restore_pwd_form();
	exit;
} }