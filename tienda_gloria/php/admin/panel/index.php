<html>
<head>
<link href="../../../gloria_rober.css" rel="stylesheet" type="text/css" />
<link href="../../../gloria.css" rel="stylesheet" type="text/css" />
<title> Panel de control acceso </title>
<script language="javascript">
//Su explorador no soporta java o lo tiene deshabilitado; esta pagina necesita javascript para funcionar correctamente<!--
//Copyright © McAnam.com

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

<link href="../../../gloria_rober.css" rel="stylesheet" type="text/css">
</head>
<?
@session_start();

require ("../../fns.php");
require ("../admin_fns.php");


  include("seguridad/securimage.php");
  $img = new Securimage();
  $valid = $img->check($_POST['code']);

  if($valid == true) {
    echo "<center>Código correcto</center>";
  } else {
    echo "<center>El código insertado no es correcto.  <a href=\"javascript:history.go(-1)\">vuelva atras</a> e inténtelo de nuevo.</center>";
 	exit;
  }


    if ( login (   $_POST['username'], $_POST['passwd']   )    )
    {
      // si se encuentran en la base de datos registrar la id de usuario
      	        $admin_user = $username;

	  session_register("admin_user");
	  $admin_user=$_SESSION['admin_user'];
	//$admin_user=$_SESSION['admin_user']; 
    }
    else
    {
	
      // login incorrecto
      //do_html_header("Problema:");
      echo "Contraseña o usuario erróneo<br>";
	  
	  echo  $_POST['username']."<br>";
	  echo  $_POST['passwd']  ;
			
      //do_html_url("login.php", "Login");
      //do_html_footer();
	  exit;

    }

if (session_is_registered("admin_user")) 

panel_control();

else
  {
  echo "No está autorizado.";

  exit;
  }
?>







</body>
</html>

