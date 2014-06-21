<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML+RDFa 1.0//EN" "http://www.w3.org/MarkUp/DTD/xhtml-rdfa-1.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" version="XHTML+RDFa 1.0" dir="ltr"
  xmlns:content="http://purl.org/rss/1.0/modules/content/"
  xmlns:dc="http://purl.org/dc/terms/"
  xmlns:foaf="http://xmlns.com/foaf/0.1/"
  xmlns:og="http://ogp.me/ns#"
  xmlns:rdfs="http://www.w3.org/2000/01/rdf-schema#"
  xmlns:sioc="http://rdfs.org/sioc/ns#"
  xmlns:sioct="http://rdfs.org/sioc/types#"
  xmlns:skos="http://www.w3.org/2004/02/skos/core#"
  xmlns:xsd="http://www.w3.org/2001/XMLSchema#">


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
</body>
