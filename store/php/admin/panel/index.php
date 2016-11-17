<!DOCTYPE html>
<html lang="es">

<head>
  <title> Panel de control acceso </title>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link href="../../../gloria_rober.css" rel="stylesheet" type="text/css" />
  <link href="../../../gloria.css" rel="stylesheet" type="text/css" />
  <script language="javascript">
  //Su explorador no soporta java o lo tiene deshabilitado; esta pagina necesita javascript para funcionar correctamente<!--
  //Copyright ? McAnam.com

  function abrir(direccion, pantallacompleta, herramientas, direcciones, estado, barramenu, barrascroll, cambiatamano, ancho, alto, izquierda, arriba, sustituir){
       var opciones = "fullscreen=" + pantallacompleta +
                   ",toolbar=" + herramientas +
                   ",location=" + direcciones +
                   ",status=" + estado +
                   ",menubar=" + barramenu +
                   ",scrollbars=" + barrascroll +
                   ",resizable=" + cambiatamano +
                   ",width=" + ancho +
                   ",height=" + alto +
                   ",left=" + izquierda +
                   ",top=" + arriba;
       var ventana = window.open(direccion,"venta",opciones,sustituir);

  }
  //-->
  </script>
</head>
<body>
<?php
@session_start();

require ("../../fns.php");
require ("../admin_fns.php");


  include("seguridad/securimage.php");
  $img = new Securimage();
  $valid = $img->check($_POST['code']);

  if($valid == true) {
    echo "<center>Código correcto</center>";
  } else {
    echo "<center>El c?digo insertado no es correcto.  <a href=\"javascript:history.go(-1)\">vuelva atras</a> e inténtelo de nuevo.</center>";
 	exit;
  }


    if (login ($_POST['username'], $_POST['passwd']))
    {
      // si se encuentran en la base de datos registrar la id de usuario
      	        $admin_user = $username;
     $_SESSION['admin_user'] = $_POST['username'];
	 // session_register("admin_user");
	  //$admin_user=$_SESSION['admin_user'];
	//$admin_user=$_SESSION['admin_user'];
    }
    else
    {

      // login incorrecto
      //do_html_header("Problema:");
      echo "Contrase?a o usuario err?neo<br>";

	  echo  $_POST['username']."<br>";
	  echo  $_POST['passwd']  ;

      //do_html_url("login.php", "Login");
      //do_html_footer();
	  exit;

    }

if ($_SESSION['admin_user'])

panel_control();

else
  {
  echo "No está autorizado.";
  exit;
  }
?>

<script src="//code.jquery.com/jquery-1.11.0.min.js"></script>
<script src="../../js/admin.js" type="text/javascript"></script>
</body>
