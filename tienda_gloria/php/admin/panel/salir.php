<link href="../../../gloria.css" rel="stylesheet" type="text/css" />

<head>
<title> Salir </title>

</head>
<script language="javascript" type="text/javascript">
function cerrarVentana(){
//la referencia de la ventana es el objeto window del popup. Lo utilizo para acceder al método close
window.close()
}
</script> 
</head>
<body>

<?


//Salimos del panel de control Log Off y nos devuelve mensaje 
require ("../../fns.php");
require ("../admin_fns.php");
@session_start();

session_unregister("admin_user") ;
session_unset();

if (session_unregister("admin_user") )
{
	echo "<h2 class='salir'>Usted Ha salido con éxito del Pandel del Administrador , Gracias</h2><br>";
	session_destroy() ;
?>	
<form>
<input type=button value="Cerrar" onClick="cerrarVentana()">
</form> 

<?
}
?>
